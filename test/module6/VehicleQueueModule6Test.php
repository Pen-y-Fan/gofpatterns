<?php

declare(strict_types=1);

namespace Tests\module5;

use App\module2\TrafficLight;
use App\module4\ConcreteVehicleFactory;
use App\module6\Time;
use App\module6\VehicleQueue;
use PHPUnit\Framework\TestCase;

class VehicleQueueModule6Test extends TestCase
{
    public function testVehicleCanEnterTheQueue(): void
    {
        Time::init(20);
        $trafficSignal = new TrafficLight();

        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(0, 0, 1, 0), $trafficSignal);

        $queue->enter();
        $queue->enter();

        $this->assertSame(3.0, $queue->getLength());
        $this->assertSame(2, $queue->getSize());
        $this->assertSame(['App\module4\Bicycle', 'App\module4\Bicycle'], $queue->list());
    }

    public function testOneHundredVehiclesQueueCanBeCreated(): void
    {
        Time::init(20);
        $trafficSignal = new TrafficLight();

        // Will create only cars, of length 6.0 x 100 = 600.0
        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(1, 0, 0, 0), $trafficSignal);

        for ($i = 0; $i < 100; $i++) {
            $queue->enter();
        }
        $this->assertSame(100, $queue->getSize());
        $this->assertSame(600.0, $queue->getLength());
        $list = $queue->list();
        $this->assertSame('App\module4\Car', $list[0]);
        $this->assertSame('App\module4\Car', $list[99]);
    }

    public function testVehiclesCanLEaveTheQueueEveryFiveSecondsOnGreen(): void
    {
        Time::init(20);
        $trafficSignal = new TrafficLight();

        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(), $trafficSignal);

        // Create 10 vehicles
        for ($i = 0; $i < 10; $i++) {
            $queue->enter();
        }

        // Change to green
        $trafficSignal->changeState();
        $this->assertSame("green", $trafficSignal->getMessage());

        // run simulation for 10 seconds
        for ($i = 0; $i < 10; $i++) {
            Time::run();
        }

        // 2 vehicles will have left, leaving 8 vehicles
        $this->assertSame(8, $queue->getSize());
    }


    public function testVehiclesCanNotLeaveTheQueueEveryFiveSecondsOnRed(): void
    {
        Time::init(20);
        $trafficSignal = new TrafficLight();

        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(), $trafficSignal);

        // Create 10 vehicles
        for ($i = 0; $i < 10; $i++) {
            $queue->enter();
        }

        // Keep signal on red
        $this->assertSame("red", $trafficSignal->getMessage());

        // run simulation for 10 seconds
        for ($i = 0; $i < 10; $i++) {
            Time::run();
        }

        // 0 vehicles will have left, leaving all 10 vehicles
        $this->assertSame(10, $queue->getSize());
    }

    public function testVehiclesQueueCanRunEmpty(): void
    {
        Time::init(20);
        $trafficSignal = new TrafficLight();

        $queue = new VehicleQueue(1, new ConcreteVehicleFactory(), $trafficSignal);

        // Create 1 vehicle
        $queue->enter();

        // change signal to green
        $trafficSignal->changeState();
        $this->assertSame("green", $trafficSignal->getMessage());

        // run simulation for 15 seconds, up to 3 vehicles could leave
        for ($i = 0; $i < 15; $i++) {
            Time::run();
        }

        // 0 vehicles will be left
        $this->assertSame(0, $queue->getSize());
    }

    /**
     * Run the Time 21 times, effectively reaching the EndOfTime and setting the instance to null
     * ready for the next test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $time = Time::getInstance();

        for ($i = 0; $i < 21; $i++) {
            $time->run();
        }
    }
}
