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

/**
 * Class ResponseOk
 * @package App\Entity\Response
 */
class ResponseOk extends JsonResponse
{
    /**
     * ResponseOk constructor.
     * @param mixed|null|array $data
     * @param int $status
     * @param array $headers
     * @param bool $json
     */
    public function __construct(array $data = null, $status = 200, array $headers = [], $json = false)
    {
        $responseData = array_merge(['success' => true] , $data);var_dump($responseData);
        parent::__construct($responseData, $status, $headers, $json);
    }
}
