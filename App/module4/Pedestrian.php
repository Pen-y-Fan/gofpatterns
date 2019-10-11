<?php

declare(strict_types=1);

namespace App\module4;

class Pedestrian extends AbstractVehicle
{
    public function __construct()
    {
        $this->length = 0;
        $this->maxSpeed = 4;
    }
}
