<?php

declare(strict_types=1);

namespace Tests\module4;

use App\module4\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testCarCanBeInstantiatedWithDefaultValues()
    {
        $car = new Car();

        $this->assertSame(6.0, $car->getLength());
        $this->assertSame(0.0, $car->getSpeed());
        $this->assertSame(120.0, $car->getMaxSpeed());
    }
}
