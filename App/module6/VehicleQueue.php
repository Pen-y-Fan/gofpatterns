<?php

declare(strict_types=1);

namespace App\module6;

use App\module2\AbstractTrafficSignal;
use App\module2\TrafficLight;
use App\module2\WalkSign;
use App\module4\ConcreteVehicleFactory;
use App\module6\Time;
use SplQueue;
use SplObserver;
use SplSubject;

class VehicleQueue implements SplObserver
{
    /**
     * @var SplQueue
     */
    protected $theQueue;

    /**
     * @var float
     */
    protected $queueLength = 0;

    /**
     * @var float
     */
    protected $vehiclesPerSecond;

    /**
     * @var AbstractTrafficSignal
     * @var TrafficLight
     * @var WalkSign

     */
    protected $signal;

    /**
     * @var ConcreteVehicleFactory
     */
    protected $theFactory;

    public function __construct(
        float $vehiclesPerSecond,
        ConcreteVehicleFactory $theFactory,
        AbstractTrafficSignal $signal
    ) {
        $this->theQueue = new SplQueue();
        $this->vehiclesPerSecond = $vehiclesPerSecond;
        $this->theFactory = $theFactory;
        $this->signal = $signal;
        Time::getInstance()->attach($this);
    }

    /**
     * The enter() method is called each second.
     *
     * @return void
     */
    public function enter(): void
    {
        $r = rand(1, 1000) / 1000;
        if ($r <= $this->vehiclesPerSecond) {
            $this->theQueue->enqueue($this->theFactory->createVehicle());
        }
    }

    /**
     * The leave() method is invoked whenever the corresponding light is green.
     *
     * @return void
     */
    public function leave(): void
    {
        $this->theQueue->rewind();
        if ($this->theQueue->valid()) {
            $this->theQueue->dequeue();
        }
    }

    /**
     * The getLength() method returns the total length in meters of the queue;
     *   that is the sum of the lengths of the individual vehicles.
     *
     * @var float $length
     * @var ConcreteVehicleFactory $vehicle
     * @return float
     */
    public function getLength(): float
    {
        $length = 0;
        $this->theQueue->rewind();
        foreach ($this->theQueue as $vehicle) {
            $length += $vehicle->getLength();
        }
        return $length;
    }

    /**
     * The getSize() method, returns the number of vehicles in the queue.
     *
     * @return integer
     */
    public function getSize(): int
    {
        return count($this->theQueue);
    }

    /**
     * Finally, list() is a method intended mostly for
     * debugging that returns the list of vehicles (classes) in the queue
     *
     * @return array
     */
    public function list(): array
    {
        $list = [];
        foreach ($this->theQueue as $vehicle) {
            $list[] = get_class($vehicle);
        }
        return $list;
    }

    /**
     * update method, part of SplSubject
     *
     * @param Time $subject
     * @return void
     */
    public function update(SplSubject $subject): void
    {
        if (
            $subject::getTime() % 5 === 0
            && ($this->signal->getMessage() == "green"
            || $this->signal->getMessage() == "walk")
        ) {
            $this->leave();
        }
    }
}
