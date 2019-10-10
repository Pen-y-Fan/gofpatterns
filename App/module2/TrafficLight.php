<?php

declare(strict_types=1);

namespace App\module2;

class TrafficLight extends AbstractTrafficSignal
{
    public function getMessage(): string
    {
        switch ($this->state) {
            case self::STOP:
                return "red";
            case self::GO:
                return "green";
            case self::CAUTION:
                return "yellow";
            default:
                return "illegal state";
        }
    }
}
