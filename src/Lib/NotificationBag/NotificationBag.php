<?php

namespace App\Lib\NotificationBag;

use Traversable;

class NotificationBag implements NotificationBagInterface
{

    private array $notifications = [];


    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->notifications);
    }

    public function add(NotificationInterface $notification): void
    {
        $this->notifications[] = $notification;
    }

    public function toExceptionTrace($exceptionClassNameOrResolver): array
    {
        $exceptions = [];


        foreach ($this as $message){
            $exceptions[] = $this->resolveExceptionClassName($exceptionClassNameOrResolver, $message);
        }

        return $exceptions;
    }

    /**
     * @param callable|string $exceptionClassNameOrResolver
     * @param $message
     * @return callable|mixed
     */
    protected function resolveExceptionClassName(callable|string $exceptionClassNameOrResolver, $message): mixed
    {

        $isClassNameProvided = is_string($exceptionClassNameOrResolver);

        return $isClassNameProvided ? new $exceptionClassNameOrResolver($message) : $exceptionClassNameOrResolver($message);
    }

}