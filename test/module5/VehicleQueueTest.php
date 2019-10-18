<?php

declare(strict_types=1);

namespace Tests\module5;

use App\module4\ConcreteVehicleFactory;
use App\module5\VehicleQueue;
use PHPUnit\Framework\TestCase;

class VehicleQueueTest extends TestCase
{
    public function testVehicleQueueCanBeEnterTheQueue()
    {
        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(0, 0, 1, 0));

        $queue->enter();
        $queue->enter();

        $this->assertSame(3.0, $queue->getLength());
        $this->assertSame(2, $queue->getSize());
    }

    public function testVehicleQueueCanBeEmpty()
    {
        $queue = new VehicleQueue(1, new ConcreteVehicleFactory());

        $queue->enter();
        $queue->enter();
        $this->assertSame(2, $queue->getSize());
        $queue->leave();
        $this->assertSame(1, $queue->getSize());
        $queue->leave();
        $this->assertSame(0, $queue->getSize());
        $queue->leave();
        $this->assertSame(0, $queue->getSize());
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
