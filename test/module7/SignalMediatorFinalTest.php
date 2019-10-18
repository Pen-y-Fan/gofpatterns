<?php

declare(strict_types=1);

namespace Tests\module7;

use App\module2\TrafficLight;
use App\module2\WalkSign;
use App\module7\SignalMediator;
use App\module6\Time;
use PHPUnit\Framework\TestCase;

/**
 * Note: Due to working with a singleton always run() the course till the endTime, at which point
 * the singleton will rest to null
 */
class SignalMediatorFinalTest extends TestCase
{
    protected $eastTrafficLight;
    
    protected $westTrafficLight;
    
    protected $northWalkSign;
    
    protected $southWalkSig;

    protected $signalMediator;
    
    public function testSignalMediatorCanBeInstantiated(): void
    {
        $this->assertSame("green", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("green", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());
    }

    public function testSignalMediatorCanBeCycleThroughAllSevenStates(): void
    {
        $this->signalMediator->changeState();
        $this->assertSame(1, $this->signalMediator->getState());
        $this->assertSame("green", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("green", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());

        $this->signalMediator->changeState();
        $this->assertSame(2, $this->signalMediator->getState());
        $this->assertSame("yellow", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("yellow", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());

        $this->signalMediator->changeState();
        $this->assertSame(3, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());

        $this->signalMediator->changeState();
        $this->assertSame(4, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Walk", $this->signalMediator->getSouthWalkSign());

        $this->signalMediator->changeState();
        $this->assertSame(5, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Flashing Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Flashing Don't Walk", $this->signalMediator->getSouthWalkSign());

        $this->signalMediator->changeState();
        $this->assertSame(6, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());
        
        $this->signalMediator->changeState();
        $this->assertSame(0, $this->signalMediator->getState());
        $this->assertSame("green", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("green", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());
    }


    public function testSignalMediatorCanBeCycleThroughAllSevenStatesViaRun(): void
    {
        $time = Time::getInstance();
        for ($i = 0; $i < 120; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(1, $this->signalMediator->getState());
        $this->assertSame("green", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("green", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());

        for ($i = 0; $i < 60; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(2, $this->signalMediator->getState());
        $this->assertSame("yellow", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("yellow", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());

        for ($i = 0; $i < 12; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(3, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());

        for ($i = 0; $i < 5; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(4, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Walk", $this->signalMediator->getSouthWalkSign());

        for ($i = 0; $i < 60; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(5, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Flashing Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Flashing Don't Walk", $this->signalMediator->getSouthWalkSign());

        for ($i = 0; $i < 20; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(6, $this->signalMediator->getState());
        $this->assertSame("red", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("red", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());
        
        for ($i = 0; $i < 5; $i++) {
            $time->run();
        }
        // $this->signalMediator->changeState();
        $this->assertSame(0, $this->signalMediator->getState());
        $this->assertSame("green", $this->signalMediator->getEastTrafficLight());
        $this->assertSame("green", $this->signalMediator->getWestTrafficLight());
        $this->assertSame("Don't Walk", $this->signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $this->signalMediator->getSouthWalkSign());
    }

    protected function setUp(): void
    {
        Time::init(6000);

        $this->eastTrafficLight = new TrafficLight();
        $this->westTrafficLight = new TrafficLight();
        $this->northWalkSign = new WalkSign();
        $this->southWalkSig = new WalkSign();

        $this->signalMediator = new SignalMediator(
            $this->eastTrafficLight,
            $this->westTrafficLight,
            $this->northWalkSign,
            $this->southWalkSig
        );
    }


    /**
     * Run the Time 120 times, effectively reaching the EndOfTime and setting the instance to null
     * ready for the next test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $time = Time::getInstance();

        for ($i = 0; $i < 6000; $i++) {
            $time->run();
        }
    }
}
