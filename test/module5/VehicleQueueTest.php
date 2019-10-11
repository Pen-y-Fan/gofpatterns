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
}
