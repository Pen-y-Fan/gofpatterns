<?php

declare(strict_types=1);

namespace App\module6;

use App\module2\TrafficLight;
use App\module4\ConcreteVehicleFactory;
use SplObjectStorage;
use SplObserver;
use SplSubject;

class VehicleQueue implements SplObserver
{
    /**
     * @var SplObjectStorage
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
     * @var TrafficLight
     */
    protected $signal;

    /**
     * @var ConcreteVehicleFactory
     */
    protected $theFactory;

    public function __construct(float $vehiclesPerSecond, ConcreteVehicleFactory $theFactory, TrafficLight $signal)
    {
        $this->theQueue = new SplObjectStorage();
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
        $r = rand(1, 10) / 10;
        if ($r <= $this->vehiclesPerSecond) {
            $this->theQueue->attach($this->theFactory->createVehicle());
            $this->queueLength += $this->theQueue->current()->getLength();
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
            $this->queueLength -= $this->theQueue->current()->getLength();
            $this->theQueue->detach($this->theQueue->current());
        }
    }

    /**
     * The getLength() method returns the total length in meters of the queue;
     *   that is the sum of the lengths of the individual vehicles.
     */
    public function getLength(): float
    {
        return $this->queueLength;
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
     * @return void
     */
    public function list(): array
    {
        $list = [];
        foreach ($this->theQueue as $vehicle) {
            $list[] = get_class($vehicle);
        }
        return $list;
    }

    public function update(SplSubject $subject): void
    {
        if (
            $subject::getTime() % 5 === 0
            && $this->signal->getMessage() == "green"
        ) {
            $this->leave();
        }
    }
}