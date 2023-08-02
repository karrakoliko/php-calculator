<?php

namespace App\Lib\NotificationBag;

interface NotificationInterface extends \Stringable
{

    public function getMessage(): string;

}