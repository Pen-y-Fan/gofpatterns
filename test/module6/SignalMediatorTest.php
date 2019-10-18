<?php

declare(strict_types=1);

namespace Tests\module6;

use App\module6\SignalMediator;
use App\module6\Time;
use PHPUnit\Framework\TestCase;

/**
 * Note: Due to working with a singleton always run() the course till the endTime, at which point
 * the singleton will rest to null
 */
class SignalMediatorTest extends TestCase
{
    public function testSignalMediatorCanBeInstantiated(): void
    {
        $signalMediator = new SignalMediator();

        $this->assertSame("Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getSouthWalkSign());
    }

    public function testSignalMediatorCanBeCycleThroughAllSevenStates(): void
    {
        $signalMediator = new SignalMediator();

        $signalMediator->changeState();
        $this->assertSame(1, $signalMediator->getState());
        $this->assertSame("Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getSouthWalkSign());

        $signalMediator->changeState();
        $this->assertSame(2, $signalMediator->getState());
        $this->assertSame("Flashing Don't Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Flashing Don't Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getSouthWalkSign());

        $signalMediator->changeState();
        $this->assertSame(3, $signalMediator->getState());
        $this->assertSame("Don't Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getSouthWalkSign());

        $signalMediator->changeState();
        $this->assertSame(4, $signalMediator->getState());
        $this->assertSame("Don't Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Walk", $signalMediator->getSouthWalkSign());

        $signalMediator->changeState();
        $this->assertSame(5, $signalMediator->getState());
        $this->assertSame("Don't Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Flashing Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Flashing Don't Walk", $signalMediator->getSouthWalkSign());

        $signalMediator->changeState();
        $this->assertSame(6, $signalMediator->getState());
        $this->assertSame("Don't Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getSouthWalkSign());
        
        $signalMediator->changeState();
        $this->assertSame(0, $signalMediator->getState());
        $this->assertSame("Walk", $signalMediator->getEastWalkSign());
        $this->assertSame("Walk", $signalMediator->getWestWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getNorthWalkSign());
        $this->assertSame("Don't Walk", $signalMediator->getSouthWalkSign());
    }


    /**
     * Run the Time 120 times, effectively reaching the EndOfTime and setting the instance to null
     * ready for the next test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Time::init(5);

        $time = Time::getInstance();

        for ($i = 0; $i < 121; $i++) {
            $time->run();
        }
    }
}
