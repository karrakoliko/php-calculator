<?php

namespace App\Number\Format;

interface NumberFormatInterface
{

    public function isMaskBased(): bool;

    public function getName(): string;

}