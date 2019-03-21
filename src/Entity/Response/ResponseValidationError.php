<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sash
 * Date: 2019-03-21
 * Time: 13:50
 */

namespace App\Entity\Response;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseOk
 * @package App\Entity\Response
 */
class ResponseValidationError extends JsonResponse
{
    public function __construct($data = null, $status = Response::HTTP_UNPROCESSABLE_ENTITY, array $headers = [], $json = false)
    {
        $errors = [];
        if ($data instanceof Form) {
            /** @var Form $data */
            /** @var FormError $error */
            foreach ($data->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }
        }

        $responseData = ['success' => false, 'errors' => $errors];
        parent::__construct($responseData, $status, $headers, $json);
    }
}
