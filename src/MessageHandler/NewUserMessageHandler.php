<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\NewUserMessage;
use App\Service\UserService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class NewUserMessageHandler
 * @package App\MessageHandler
 */
class NewUserMessageHandler implements MessageHandlerInterface
{
    /** @var UserService */
    private $userService;

    /**
     * NewUserMessageHandler constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param NewUserMessage $message
     * @throws \Throwable
     */
    public function __invoke(NewUserMessage $message)
    {
        $this->userService->createUser($message->getUser());
    }
}
