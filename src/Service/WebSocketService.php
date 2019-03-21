<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sash
 * Date: 2019-03-21
 * Time: 14:42
 */

namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use phpcent\Client as WebSocketClient;

/**
 * WebSocketService
 */
class WebSocketService
{
    const WEBSOCKETS_API = '/api';
    const CHANNEL_NAME = 'default_channel';

    /** @var WebSocketClient */
    private $client;

    /**
     * WebSocketService constructor.
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->client = new \phpcent\Client(
            sprintf("%s://%s:%s/%s",
                $parameterBag->get('app.web_sockets_protocol'),
                $parameterBag->get('app.web_sockets_host'),
                $parameterBag->get('app.web_sockets_port'),
                static::WEBSOCKETS_API
            )
        );
        $this->client->setApiKey($parameterBag->get('app.web_sockets_api_key'));
    }

    public function generateId()
    {
        return $this->client->generateConnectionToken();
    }

    /**
     * @param string $message
     */
    public function publishMessage(string $message)
    {
        $this->client->publish(static::CHANNEL_NAME, ['message' => $message]);
    }
}
