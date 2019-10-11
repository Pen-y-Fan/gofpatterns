<?php

declare(strict_types=1);

namespace Tests\module4;

use App\module4\Bus;
use PHPUnit\Framework\TestCase;

class BusTest extends TestCase
{
    public function testCarCanBeInstantiatedWithDefaultValues()
    {
        $bus = new Bus();

        $this->assertSame(18.0, $bus->getLength());
        $this->assertSame(0.0, $bus->getSpeed());
        $this->assertSame(92.0, $bus->getMaxSpeed());
    }
}
