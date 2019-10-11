<?php

declare(strict_types=1);

namespace Tests\module4;

use App\module4\Bicycle;
use PHPUnit\Framework\TestCase;

class BicycleTest extends TestCase
{
    public function testCarCanBeInstantiatedWithDefaultValues()
    {
        $bicycle = new Bicycle();

        $this->assertSame(1.5, $bicycle->getLength());
        $this->assertSame(0.0, $bicycle->getSpeed());
        $this->assertSame(25.0, $bicycle->getMaxSpeed());
    }
}
