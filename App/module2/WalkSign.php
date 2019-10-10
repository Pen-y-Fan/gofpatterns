<?php

declare(strict_types=1);

namespace App\module2;

class WalkSign extends AbstractTrafficSignal
{
    public function getMessage(): string
    {
        switch ($this->state) {
            case self::STOP:
                return "Don't Walk";
            case self::GO:
                return "Walk";
            case self::CAUTION:
                return "Flashing Don't Walk";
            default:
                return "illegal state";
        }
    }
}
