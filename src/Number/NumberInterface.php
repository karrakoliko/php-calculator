<?php

namespace App\Number;

interface NumberInterface extends \Stringable
{

    public function getValue();

    public function equals(NumberInterface $number): bool;
}