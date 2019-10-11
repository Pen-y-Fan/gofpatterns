<?php

declare(strict_types=1);

namespace Tests\module4;

use App\module4\Bicycle;
use App\module4\Bus;
use App\module4\Car;
use App\module4\ConcreteVehicleFactory;
use App\module4\Pedestrian;
use PHPUnit\Framework\TestCase;

class ConcreteVehicleTest extends TestCase
{
    public function testCarCanBeInstantiated()
    {
        $vehicleFactory = new ConcreteVehicleFactory(1, 0, 0, 0);
        $car = $vehicleFactory->createVehicle();

        $this->assertInstanceOf(Car::class, $car);
        $this->assertSame(120.0, $car->getMaxSpeed());
    }

    public function testBusCanBeInstantiated()
    {
        $vehicleFactory = new ConcreteVehicleFactory(0, 1, 0, 0);
        $bus = $vehicleFactory->createVehicle();

        $this->assertInstanceOf(Bus::class, $bus);
        $this->assertSame(92.0, $bus->getMaxSpeed());
    }

    public function testBicycleCanBeInstantiated()
    {
        $vehicleFactory = new ConcreteVehicleFactory(0, 0, 1, 0);
        $bicycle = $vehicleFactory->createVehicle();

        $this->assertInstanceOf(Bicycle::class, $bicycle);
        $this->assertSame(25.0, $bicycle->getMaxSpeed());
    }

    public function testPedestrianCanBeInstantiated()
    {
        $vehicleFactory = new ConcreteVehicleFactory(0, 0, 0, 1);
        $pedestrian = $vehicleFactory->createVehicle();

        $this->assertInstanceOf(Pedestrian::class, $pedestrian);
        $this->assertSame(4.0, $pedestrian->getMaxSpeed());
    }
}
