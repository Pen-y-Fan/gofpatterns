<?php

declare(strict_types=1);

namespace App\module4;

abstract class AbstractVehicle
{
    protected const MIN_SPEED = 0;
    protected $speed = 0;
    protected $maxSpeed;
    protected $length;

    public function getSpeed(): float
    {
        return $this->speed;
    }
    
    public function getMaxSpeed(): float
    {
        return $this->maxSpeed;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function accelerate(float $deltaV): void
    {
        $deltaV = abs($deltaV);
        if ($this->speed += $deltaV > $this->maxSpeed) {
            $this->speed = $this->maxSpeed;
            return;
        }
        $this->speed += $deltaV;
    }

    public function decelerate(float $deltaV): void
    {
        $deltaV = abs($deltaV);
        if ($this->speed -= $deltaV < self::MIN_SPEED) {
            $this->speed = self::MIN_SPEED;
            return;
        }
        $this->speed -= $deltaV;
    }

    // Not sure on __toString, the Java code was:
    // return getClass().getName();
    public function __toString(): string
    {
        return (string) __CLASS__;
    }
}
