<?php

namespace Tests\module2;

use App\module2\TrafficLight;
use PHPUnit\Framework\TestCase;

class TrafficLightTest extends TestCase
{
    /** @test */
    public function trafficLightStateDefaultsToRed(): void
    {
        $trafficSignal = new TrafficLight();
        $this->assertSame("red", $trafficSignal->getMessage());
    }

    /** @test */
    public function trafficLightCycleThroughAllStates(): void
    {
        $trafficSignal = new TrafficLight();

        $trafficSignal->changeState();
        $this->assertSame("green", $trafficSignal->getMessage());

        $trafficSignal->changeState();
        $this->assertSame("yellow", $trafficSignal->getMessage());

        $trafficSignal->changeState();
        $this->assertSame("red", $trafficSignal->getMessage());

        $trafficSignal->changeState();
        $this->assertSame("green", $trafficSignal->getMessage());
    }
}
