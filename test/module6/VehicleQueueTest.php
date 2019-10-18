<?php

declare(strict_types=1);

namespace Tests\module6;

use App\module4\ConcreteVehicleFactory;
use App\module5\VehicleQueue;
use PHPUnit\Framework\TestCase;

class VehicleQueueTest extends TestCase
{
    public function testVehicleCanEnterTheQueue(): void
    {
        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(0, 0, 1, 0));

        $queue->enter();
        $queue->enter();

        $this->assertSame(3.0, $queue->getLength());
        $this->assertSame(2, $queue->getSize());
        $this->assertSame(['App\module4\Bicycle', 'App\module4\Bicycle'], $queue->list());
    }

    public function testOneHundredVehiclesQueueCanBeCreated(): void
    {
        // Will create only cars, of length 6.0 x 100 = 600.0
        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(1, 0, 0, 0));

        for ($i = 0; $i < 100; $i++) {
            $queue->enter();
        }
        $this->assertSame(100, $queue->getSize());
        $this->assertSame(600.0, $queue->getLength());
        $list = $queue->list();
        $this->assertSame('App\module4\Car', $list[0]);
        $this->assertSame('App\module4\Car', $list[99]);
    }
}
