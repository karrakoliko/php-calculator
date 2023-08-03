<?php

namespace App\Number\Format\Guesser;

use App\Number\Format\NumberFormatInterface;

interface NumberFormatGuesserInterface
{

    public function guess($number): ?NumberFormatInterface;

}