<?php

declare(strict_types=1);

namespace App\module4;

class Bus extends AbstractVehicle
{
    public function __construct()
    {
        $this->length = 18;
        $this->maxSpeed = 92;
    }
}
