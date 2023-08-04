<?php

namespace App\Calculator\Trait;

use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;

/**
 * @property array $operands
 */
trait ThrowIfNoOperandsGivenTrait
{
    /**
     * @return void
     * @throws NoOperandsGivenException
     */
    protected function throwIfNoOperandsGiven(): void
    {
        if (!is_array($this->operands) || !count($this->operands)) {
            throw new NoOperandsGivenException('No operands given');
        }
    }

}