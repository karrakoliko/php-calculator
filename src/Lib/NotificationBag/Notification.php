<?php

namespace App\Lib\NotificationBag;

class Notification implements NotificationInterface
{

    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function __toString(): string
    {
        return $this->getMessage();
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}