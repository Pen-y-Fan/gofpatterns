<?php

declare(strict_types=1);

namespace Tests\module6;

use App\module6\Time;
use PHPUnit\Framework\TestCase;

/**
 * Note: Due to working with a singleton always run() the course till the endTime, at which point
 * the singleton will rest to null
 */
class TimeTest extends TestCase
{
    public function testSameInstance(): void
    {
        Time::init(5);
        $firstCall = Time::getInstance();
        $secondCall = Time::getInstance();

        $this->assertInstanceOf(Time::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
        $this->assertSame(0, $secondCall->getTime());
        $this->assertSame($firstCall->getTime(), $secondCall->getTime());
    }

    /**
     * Run the Time 6 times, effectively reaching the EndOfTime and setting the instance to null
     * ready for the next test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $time = Time::getInstance();

        for ($i = 0; $i < 6; $i++) {
            $time->run();
        }
    }
}
