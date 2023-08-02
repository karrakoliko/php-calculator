<?php

namespace App\Lib\NotificationBag;

interface NotificationBagInterface extends \IteratorAggregate
{

    public function add(NotificationInterface $notification): void;

    /**
     * @param callable|string $exceptionClassNameOrResolver provide NeededException::class or resolver function like <pre>
     *     function (Notification $n){
     *      ... return NeededException::class;
     *      }
     * </pre>
     * @return \Exception[]
     */
    public function toExceptionTrace($exceptionClassNameOrResolver): array;

}