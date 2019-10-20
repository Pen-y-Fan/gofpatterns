<?php

declare(strict_types=1);

namespace App\module5;

use App\module4\AbstractVehicleFactory;
use App\module4\ConcreteVehicleFactory;
use SplQueue;

class VehicleQueue
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
     * @var ConcreteVehicleFactory
     */
    protected $theFactory;

    public function __construct(float $vehiclesPerSecond, ConcreteVehicleFactory $theFactory)
    {
        $this->theQueue = new SplQueue();
        $this->vehiclesPerSecond = $vehiclesPerSecond;
        $this->theFactory = $theFactory;
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
     * @var AbstractVehicleFactory $vehicle
     * @var int $length
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
            /* $vehicle ConcreteVehicleFactory */
            $list[] = get_class($vehicle);
        }
        return $list;
    }
}
