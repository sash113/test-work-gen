<?php
declare(strict_types=1);

namespace App\Controller;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractBaseRestController
 * @package App\Controller
 */
abstract class AbstractBaseRestController extends AbstractFOSRestController
{
    /**
     * @param string $formType
     * @param Request $request
     * @param mixed $entity
     * @return \Symfony\Component\Form\FormInterface
     */
    public function processForm(string $formType, Request $request, $entity)
    {
        $form = $this->createForm($formType, $entity);
        $form->submit($request->request->all());

        return $form;
    }
}
