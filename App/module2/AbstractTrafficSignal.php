<?php

declare(strict_types=1);

namespace App\module2;

abstract class AbstractTrafficSignal
{

    // @var int
    public const GO = 0;
    // @var int
    public const CAUTION = 1;
    // @var int
    public const STOP = 2;
    // @var int
    public const NUMBER_OF_STATES = 3;

    // boolean
    public $passageRequested = false;

    // int
    public $state = self::STOP;

    public function getPassageRequested(): bool
    {
        return $this->passageRequested;
    }

    public function requestPassage(): void
    {
        if ($this->state == self::STOP) {
            $this->passageRequested = true;
        }
    }

    public function passageGranted(): void
    {
        $this->passageRequested = false;
    }

    public function changeState(): void
    {
        $this->state = (++$this->state) % self::NUMBER_OF_STATES;
        if ($this->state == self::GO) {
            $this->passageRequested = false;
        }
    }

    public function getState(): int
    {
        return $this->state;
    }
    abstract public function getMessage(): string;

    public function __toString()
    {
        return "[" . get_class($this) . ": " .
        $this->getMessage() . " " . $this->passageRequested . "]";
    }
}
