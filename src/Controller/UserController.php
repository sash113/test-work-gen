<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\User;
use App\Form\UserFormType;
use App\Message\NewUserMessage;
use App\Repository\UserRepository;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Knp\Component\Pager\Pagination\SlidingPagination;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractBaseRestController
{
    const ITEMS_PER_PAGE = 10;

    /** @var SessionService */
    private $sessionService;
    /** @var MessageBusInterface */
    private $messageBus;
    /** @var UserRepository */
    private $userRepository;
    /** @var PaginatorInterface */
    private $paginator;

    /**
     * UserController constructor.
     * @param SessionService $sessionService
     * @param MessageBusInterface $messageBus
     * @param UserRepository $userRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        SessionService $sessionService,
        MessageBusInterface $messageBus,
        UserRepository $userRepository,
        PaginatorInterface $paginator
    ) {
        $this->sessionService = $sessionService;
        $this->messageBus = $messageBus;
        $this->userRepository = $userRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/user", name="user_register", methods={"POST"})
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function registerAction(Request $request): array
    {
        /** @var string $sessionId */
        $sessionId = $this->sessionService->generateSessionId();
        $user = new User();

        /** @var FormInterface $form */
        $form = $this->processForm(UserFormType::class, $request, $user);

        if ($form->isValid() == false) {
            return ['success' => false, 'errors' => $form->getErrors()];
        }

        $phones = $request->request->get('phoneNumbers', []);
        foreach ($phones as $phone) {
            $phoneEntity = new Phone();
            $phoneEntity->setPhone($phone);
            $user->addPhone($phoneEntity);
        }

        // Dispatch notify about new user
        $this->messageBus->dispatch(new NewUserMessage($sessionId, $user));

        return [
            'success' => true,
            'data' => ['sessionId' => $sessionId]
        ];
    }

    /**
     * @Route("/user", name="user_search", methods={"GET"})
     * @View(serializerGroups={"default"})
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function searchAction(Request $request)
    {
        /**
         * @var Query $query
         */
        $query = $this->userRepository->searchUserByName(
            $request->query->get('firstName'),
            $request->query->get('lastName')
        );

        /** @var SlidingPagination $pagination */
        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            self::ITEMS_PER_PAGE,
            [
                'sort' => $request->query->get('sort'),
                'direction' => $request->query->get('direction')
            ]
        );

        return
            [
                'success' => true,
                'data' => $pagination, 'pagination' => $pagination->getPaginationData()
            ];
    }
}
