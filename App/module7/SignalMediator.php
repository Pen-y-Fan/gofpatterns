<?php

declare(strict_types=1);

namespace App\module7;

use App\module2\AbstractTrafficSignal;
use App\module6\Time;
use SplObserver;
use SplSubject;

/**
 * Signal Mediator controls the traffic light system
 */
class SignalMediator implements SplObserver
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
    private $eastTrafficLight;

    /**
     * @var AbstractTrafficSignal
     */
    private $westTrafficLight;

    /**
     * @var AbstractTrafficSignal
     */
    private $northWalkSign;

    /**
     * @var AbstractTrafficSignal
     */
    private $southWalkSign;

    public function __construct(
        AbstractTrafficSignal $eastTrafficLight,
        AbstractTrafficSignal $westTrafficLight,
        AbstractTrafficSignal $northWalkSign,
        AbstractTrafficSignal $southWalkSign
    ) {
        Time::init(5);
        $this->eastTrafficLight = $eastTrafficLight;
        $this->westTrafficLight = $westTrafficLight;
        $this->northWalkSign = $northWalkSign; // Stop
        $this->southWalkSign = $southWalkSign; // Stop
        
        $this->eastTrafficLight->changeState(); // Walk
        $this->westTrafficLight->changeState(); // Walk
        
        $this->state = 0;
        $this->nextInterval = 120;
        Time::getInstance()->attach($this);
    }

    public function changeState(): void
    {
        $this->state = (++$this->state) % self::NUMBER_OF_STATES;

        switch ($this->state) {
            case 0:
                $this->eastTrafficLight->changeState(); // stop->go
                $this->westTrafficLight->changeState(); // stop->go
                $this->eastTrafficLight->passageGranted(); // stop->go
                $this->westTrafficLight->passageGranted(); // stop->go
                $this->nextInterval += 120;
                break;

            case 1:
                $this->eastTrafficLight->requestPassage();
                $this->westTrafficLight->requestPassage();
                $this->northWalkSign->requestPassage();
                $this->southWalkSign->requestPassage();
                $this->nextInterval += 60;
                break;
            
            case 2:
                $this->eastTrafficLight->requestPassage();
                $this->westTrafficLight->requestPassage();
                $this->northWalkSign->requestPassage();
                $this->southWalkSign->requestPassage();
                $this->eastTrafficLight->changeState(); // go->Caution
                $this->westTrafficLight->changeState(); // go->Caution
                $this->nextInterval += 12;
                break;

            case 3:
                $this->eastTrafficLight->requestPassage();
                $this->westTrafficLight->requestPassage();
                $this->northWalkSign->requestPassage();
                $this->southWalkSign->requestPassage();
                $this->eastTrafficLight->changeState(); // Caution->Stop
                $this->westTrafficLight->changeState(); // Caution->Stop
                $this->nextInterval += 5;
                break;

            case 4:
                $this->northWalkSign->changeState(); // Stop->Go
                $this->southWalkSign->changeState(); // Stop->Go
                $this->northWalkSign->passageGranted();
                $this->southWalkSign->passageGranted();
                $this->nextInterval += 60;
                break;

            case 5:
                $this->northWalkSign->changeState(); // Go->Caution
                $this->southWalkSign->changeState(); // Go->Caution
                $this->nextInterval += 20;
                break;

            case 6:
                $this->northWalkSign->changeState(); // Caution->Stop
                $this->southWalkSign->changeState(); // Caution->Stop
                $this->nextInterval += 5;
                break;

            default:
                throw new Exception("Error Processing Request", 1);
                break;
        }
    }

    public function getEastTrafficLight(): string
    {
        return $this->eastTrafficLight->getMessage();
    }

    public function getWestTrafficLight(): string
    {
        return $this->westTrafficLight->getMessage();
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

    public function update(SplSubject $subject): void
    {
        if ($subject::getTime() >= $this->nextInterval) {
            $this->changeState();
        }
    }
}
