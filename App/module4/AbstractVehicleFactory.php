<?php

declare(strict_types=1);

namespace App\module4;

abstract class AbstractVehicleFactory
{
    protected $chanceCar;
    protected $chanceBus;
    protected $chanceBicycle;
    protected $chancePedestrian;

    protected function __construct(
        float $chanceCar = 80.0,
        float $chanceBus = 10.0,
        float $chanceBicycle = 10.0,
        float $chancePedestrian = 0.0
    ) {
        // Negative probabilities make no sense.
        // Therefore, enforce the constraint that
        // each probability is greater than zero
        if ($chanceCar < 0.0) {
            $chanceCar = 0.0;
        }
        if ($chanceBus < 0.0) {
            $chanceBus = 0.0;
        }
        if ($chanceBicycle < 0.0) {
            $chanceBicycle = 0.0;
        }
        if ($chancePedestrian < 0.0) {
            $chancePedestrian = 0.0;
        }
        
        // Since you must enforce the constraint that the sum
        // of the probabilities is 1.0 (100%), you
        // have to normalize. You should not assume that
        // the arguments add to 1.00 (100%)
        // This has the beneficial side effect of allowing
        // clients to use either floating point numbers between
        // 0.0 and 1.0 or percentages between 0 and 100 as they prefer.
        $normalization  = $chanceCar + $chanceBus + $chanceBicycle + $chancePedestrian;

        // avoid division by zero
        if ($normalization == 0) {
            $normalization = 1.0;
        }

        $this->chanceCar = $chanceCar / $normalization;
        $this->chanceBus = $chanceBus / $normalization;
        $this->chanceBicycle = $chanceBicycle / $normalization;
        $this->chancePedestrian = $chancePedestrian / $normalization;
    }

    abstract public function createVehicle();
}
