<?php

declare(strict_types=1);

namespace App\module7;

use App\module2\TrafficLight;
use App\module2\WalkSign;
use App\module4\ConcreteVehicleFactory;
use App\module7\SignalMediator;
use App\module6\Time;
use App\module7\VehicleQueue;
use SplObserver;
use SplSubject;

/**
 * Note: Due to working with Time (singleton) always run() the course till the endTime, at which point
 * the singleton will rest to null
 */
class Client implements SplObserver
{
    protected $eastQueue;

    protected $westQueue;

    protected $northQueue;

    protected $southQueue;

    protected $simulationTime;

    /**
     * Add at test to run the client as a test and view the output
     */
    public function __construct(int $simulationTime)
    {
        Time::init($simulationTime);

        $this->simulationTime = $simulationTime;

        $eastTrafficLight = new TrafficLight();
        $westTrafficLight = new TrafficLight();
        $northWalkSign = new WalkSign();
        $southWalkSign = new WalkSign();

        new SignalMediator($eastTrafficLight, $westTrafficLight, $northWalkSign, $southWalkSign);
        
        $this->eastQueue = new VehicleQueue(1 / 20, new ConcreteVehicleFactory(), $eastTrafficLight);
        $this->westQueue = new VehicleQueue(1 / 30, new ConcreteVehicleFactory(), $westTrafficLight);
        $this->northQueue = new VehicleQueue(1 / 100, new ConcreteVehicleFactory(0, 0, 10, 90), $northWalkSign);
        $this->southQueue = new VehicleQueue(1 / 50, new ConcreteVehicleFactory(0, 0, 10, 90), $southWalkSign);
        Time::getInstance()->attach($this);

        echo "\n";
        echo "Seconds\tEastNo\tEastLen\tWestNo\tWestLen\tNorthNo\tSouthNo\n";
        echo "-------\t------\t-------\t------\t-------\t-------\t-------\n";
    }
    
    public function run(): bool
    {
        for ($i = 0; $i < $this->simulationTime; $i++) {
            Time::run();
        }
        return true;
    }

    public function update(SplSubject $subject): void
    {
        echo $subject->getTime() . "\t";
        echo $this->eastQueue->getSize() . "\t" . $this->eastQueue->getLength() . "\t";
        echo $this->westQueue->getSize() . "\t" . $this->westQueue->getLength() . "\t";
        echo $this->northQueue->getSize() . "\t";
        echo $this->southQueue->getSize() . "\n";
    }
}
