<?php

declare(strict_types=1);

namespace App\module4;

class Car extends AbstractVehicle
{
    public function __construct()
    {
        $this->maxSpeed = 120;
        $this->length = 6.0;
    }
}
