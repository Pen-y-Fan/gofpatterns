<?php

namespace Tests\module2;

use App\module2\WalkSign;
use PHPUnit\Framework\TestCase;

class WalkSignTest extends TestCase
{
    /** @test */
    public function walkSignStateDefaultsToRed(): void
    {
        $walkSign = new WalkSign();
        $this->assertSame("Don't Walk", $walkSign->getMessage());
    }

    /** @test */
    public function walkSignCanCycleThroughAllStates(): void
    {
        $walkSign = new WalkSign();
        $this->assertSame("Don't Walk", $walkSign->getMessage());

        $walkSign->changeState();
        $this->assertSame("Walk", $walkSign->getMessage());

        $walkSign->changeState();
        $this->assertSame("Flashing Don't Walk", $walkSign->getMessage());

        $walkSign->changeState();
        $this->assertSame("Don't Walk", $walkSign->getMessage());

        $walkSign->changeState();
        $this->assertSame("Walk", $walkSign->getMessage());
    }
}
