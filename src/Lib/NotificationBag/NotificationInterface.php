<?php

namespace App\Lib\NotificationBag;

use Stringable;

interface NotificationInterface extends Stringable
{

    public function getMessage(): string;

}