<?php

declare(strict_types=1);

namespace Tests\module3;

use App\module3\Clock;
use PHPUnit\Framework\TestCase;

/**
 * Note: Due to working with a singleton always run() the course till the endTime, at which point
 * the singleton will rest to null
 */
class ClockTest extends TestCase
{
    public function testSameInstance()
    {
        $firstCall = Clock::time(5);
        $secondCall = Clock::time(10); // The endTime of 10 will have no effect

        $this->assertInstanceOf(Clock::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
        $this->assertSame(0, $secondCall->getTime());
        $this->assertSame($firstCall->getTime(), $secondCall->getTime());
    }

    public function testClockCanRunUpToItsEndTime()
    {
        $time = Clock::time(5);

        $time->run();
        
        $this->assertSame(1, $time->getTime());

        for ($i = 0; $i < 4; $i++) {
            $time->run();
        }

        $this->assertSame(5, $time->getTime());
        $time->run();
    }

    public function testClockStopsAfterTheMaxTime()
    {
        $time = Clock::time(5);

        for ($i = 0; $i < 7; $i++) {
            $time->run();
        }

        $this->assertSame(0, $time->getTime());
    }

    public function testClockStopsAfterTheMaxTimeWithTheSameTwoInstances()
    {
        $time = Clock::time(5);
        $time1 = Clock::time(10);

        for ($i = 0; $i < 4; $i++) {
            $time->run();
        }
        $this->assertSame(4, $time->getTime());
        $this->assertSame(4, $time1->getTime());

        // Doesn't matter if run() is called by $time1 or $time
        $time1->run();
        $time1->run();
        $this->assertSame(0, $time->getTime());
        $this->assertSame(0, $time1->getTime());  // EndOfTime was still set to 5
    }

    /**
     * Run the Clock 6 times, effectively reaching the EndOfTime and setting the instance to null
     * ready for the next test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $time = Clock::time(5);

        for ($i = 0; $i < 6; $i++) {
            $time->run();
        }
    }
}
