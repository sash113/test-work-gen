<?php
declare(strict_types=1);

namespace App\Service;

/**
 * Class SessionService
 * @package App\Service
 */
class SessionService
{
    const SESSION_LENGTH = 10;

    /** @var WebSocketService  */
    private $webSocketService;

    public function __construct(WebSocketService $webSocketService)
    {
        $this->webSocketService = $webSocketService;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function generateSessionId(): string
    {
        return $this->webSocketService->generateId();
    }
}
