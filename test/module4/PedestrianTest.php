<?php

declare(strict_types=1);

namespace Tests\module4;

use App\module4\Pedestrian;
use PHPUnit\Framework\TestCase;

class PedestrianTest extends TestCase
{
    public function testCarCanBeInstantiatedWithDefaultValues()
    {
        $pedestrian = new Pedestrian();

        $this->assertSame(0.0, $pedestrian->getLength());
        $this->assertSame(0.0, $pedestrian->getSpeed());
        $this->assertSame(4.0, $pedestrian->getMaxSpeed());
    }
}
