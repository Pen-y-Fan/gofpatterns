<?php

declare(strict_types=1);

namespace App\module6;

use App\module2\AbstractTrafficSignal;
use App\module2\WalkSign;
use Exception;

/**
 * https://www.gofpatterns.com/design-patterns/module6/signalMediator-class-exercise-result.php?exerciseInput=%3C%3Fphp%0D%
 */
class SignalMediator
{
    /**
     * @var integer from 0 to (NUMBER_OF_STATES-1)
     */
    private $state;

    /**
     * @const Maximum number of states
     */
    public const NUMBER_OF_STATES = 7;

    /**
     * @var AbstractTrafficSignal
     */
    private $eastWalkSign;

    /**
     * @var AbstractTrafficSignal
     */
    private $westWalkSign;

    /**
     * @var AbstractTrafficSignal
     */
    private $northWalkSign;

    /**
     * @var AbstractTrafficSignal
     */
    private $southWalkSign;

    public function __construct()
    {
        $this->eastWalkSign = new WalkSign();
        $this->westWalkSign = new WalkSign();
        $this->northWalkSign = new WalkSign(); // Stop
        $this->southWalkSign = new WalkSign(); // Stop

        $this->eastWalkSign->changeState(); // Walk
        $this->westWalkSign->changeState(); // Walk

        $this->state = 0;
    }

    public function changeState(): void
    {
        $this->state = (++$this->state) % self::NUMBER_OF_STATES;

        switch ($this->state) {
            case 0:
                $this->eastWalkSign->changeState(); // stop->go
                $this->westWalkSign->changeState(); // stop->go
                $this->eastWalkSign->passageGranted(); // stop->go
                $this->westWalkSign->passageGranted(); // stop->go
                Time::init(120); // Inf? Or min?
                break;

            case 1:
                $this->eastWalkSign->requestPassage();
                $this->westWalkSign->requestPassage();
                $this->northWalkSign->requestPassage();
                $this->southWalkSign->requestPassage();
                Time::init(60);
                break;
            
            case 2:
                $this->eastWalkSign->requestPassage();
                $this->westWalkSign->requestPassage();
                $this->northWalkSign->requestPassage();
                $this->southWalkSign->requestPassage();
                $this->eastWalkSign->changeState(); // go->Caution
                $this->westWalkSign->changeState(); // go->Caution
                Time::init(12);
                break;

            case 3:
                $this->eastWalkSign->requestPassage();
                $this->westWalkSign->requestPassage();
                $this->northWalkSign->requestPassage();
                $this->southWalkSign->requestPassage();
                $this->eastWalkSign->changeState(); // Caution->Stop
                $this->westWalkSign->changeState(); // Caution->Stop
                Time::init(5);
                break;

            case 4:
                $this->northWalkSign->changeState(); // Stop->Go
                $this->southWalkSign->changeState(); // Stop->Go
                $this->northWalkSign->passageGranted();
                $this->southWalkSign->passageGranted();
                Time::init(60);
                break;

            case 5:
                $this->northWalkSign->changeState(); // Go->Caution
                $this->southWalkSign->changeState(); // Go->Caution
                Time::init(20);
                break;

            case 6:
                $this->northWalkSign->changeState(); // Caution->Stop
                $this->southWalkSign->changeState(); // Caution->Stop
                Time::init(5);
                break;

            default:
                throw new Exception("Error Processing Request", 1);
                break;
        }
    }

    public function getEastWalkSign(): string
    {
        return $this->eastWalkSign->getMessage();
    }

    public function getWestWalkSign(): string
    {
        return $this->westWalkSign->getMessage();
    }

    public function getNorthWalkSign(): string
    {
        return $this->northWalkSign->getMessage();
    }

    public function getSouthWalkSign(): string
    {
        return $this->southWalkSign->getMessage();
    }

    /**
     * getState will return the current state
     *
     * @return integer
     */
    public function getState(): int
    {
        return $this->state;
    }
}
