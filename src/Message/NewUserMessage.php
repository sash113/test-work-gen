<?php
declare(strict_types=1);

namespace App\Message;

use App\Entity\User;

/**
 * Class NewUserMessage
 * @package App\Message
 */
class NewUserMessage
{
    /** @var string */
    private $sessionId;
    /** @var User */
    private $user;

    /** @var integer */
    private $datetime;

    public function __construct(string $sessionId, User $user, ?int $datetime = null)
    {
        $this->sessionId = $sessionId;
        $this->user = $user;
        if ($datetime === null) {
            $this->datetime = time();
        }
        $this->datetime = $datetime;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getDatetime(): ?int
    {
        return $this->datetime;
    }

    /**
     * @param int $datetime
     */
    public function setDatetime(int $datetime): void
    {
        $this->datetime = $datetime;
    }
}
