<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sash
 * Date: 2019-03-21
 * Time: 13:50
 */

namespace App\Entity\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseOk
 * @package App\Entity\Response
 */
class ResponseError extends JsonResponse
{
    public function __construct($data = null, $status = Response::HTTP_UNPROCESSABLE_ENTITY, array $headers = [], $json = false)
    {
        $responseData = ['success' => false, 'errors' => $data];
        parent::__construct($responseData, $status, $headers, $json);
    }
}
