<?php

namespace App\Lib\NotificationBag;

use Exception;
use IteratorAggregate;

interface NotificationBagInterface extends IteratorAggregate
{

    public function add(NotificationInterface $notification): void;

    /**
     * @param callable|string $exceptionClassNameOrResolver provide NeededException::class or resolver function like <pre>
     *     function (Notification $n){
     *      ... return NeededException::class;
     *      }
     * </pre>
     * @return Exception[]
     */
    public function toExceptionTrace($exceptionClassNameOrResolver): array;

}