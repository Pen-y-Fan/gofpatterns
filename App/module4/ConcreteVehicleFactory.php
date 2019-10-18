<?php

declare(strict_types=1);

namespace App\module4;

class ConcreteVehicleFactory extends AbstractVehicleFactory
{
    public function __construct(
        float $chanceCar = 80.0,
        float $chanceBus = 10.0,
        float $chanceBicycle = 10.0,
        float $chancePedestrian = 0.0
    ) {
        parent::__construct($chanceCar, $chanceBus, $chanceBicycle, $chancePedestrian);
    }

    public function createVehicle(): AbstractVehicle
    {
        $randomVehicle = rand(0, 100) / 100;

        if ($randomVehicle <= $this->chanceCar) {
            return new Car();
        }

        if ($randomVehicle <= ($this->chanceCar + $this->chanceBus)) {
            return new Bus();
        }

        if ($randomVehicle <= ($this->chanceCar + $this->chanceBus + $this->chanceBicycle)) {
            return new Bicycle();
        }

        return new Pedestrian();
    }
}
