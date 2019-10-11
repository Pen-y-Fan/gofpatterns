<?php

declare(strict_types=1);

namespace App\module4;

class Bicycle extends AbstractVehicle
{
    public function __construct()
    {
        $this->length = 1.5;
        $this->maxSpeed = 25;
    }
}
