<?php

declare(strict_types=1);

namespace Tests\module7;

use App\module6\Time;
use App\module7\Client;
use PHPUnit\Framework\TestCase;

/**
 * Note: Due to working with Time (singleton) always run() the course till the endTime, at which point
 * the singleton will rest to null
 */
class ClientTest extends TestCase
{
    /**
     * Add at test to run the client, to view the output
     */
    // public function testClient(): void
    // {
    //     $client = new Client(100);
    //     $ran = $client->run();

    //     $this->assertTrue($ran);
    // }

    /**
     * Allows above testClient to be commented out without raising a warning
     *
     * @return void
     */
    public function testDummy()
    {
        $this->assertTrue(true);
    }

    
    /**
     * Run the Time 6 times, effectively reaching the EndOfTime and setting the instance to null
     * ready for the next test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Time::init(1);

        // $time = Time::getInstance();

        for ($i = 0; $i < 6; $i++) {
            Time::run();
        }
    }
}
