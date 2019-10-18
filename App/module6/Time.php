<?php

declare(strict_types=1);

namespace App\module6;

use SplObjectStorage;
use SplObserver;
use SplSubject;

final class Time implements SplSubject
{
    /**
     * @var integer
     */
    private static $currentTime = 0;
    
    /**
     * @var integer
     */
    private static $endOfTime;

    /**
     * @var Time
     */
    private static $instance = null;

    /**
     * @var SplObjectStorage
     */
    private static $observers;

    /**
     * Initialise the singleton Time
     * @param integer $endTime
     */
    public static function init(int $endTime): void
    {
        if (null === static::$instance) {
            static::$instance = new static();
            static::$endOfTime = $endTime;
            static::$currentTime = 0;
            static::$observers = new SplObjectStorage();
        }
    }

    /**
     * @return Time
     */
    public static function getInstance(): Time
    {
        return static::$instance;
    }

    /**
     * Simulate the passage of time (1 second) per run
     * @return void
     */
    public static function run(): void
    {
        if (static::$currentTime < static::$endOfTime) {
            static::$currentTime++;
            static::$instance->notify();
        } else {
            static::$instance = null;
            static::$currentTime = 0;
            static::$endOfTime = 0;
        }
    }

    /**
     * @return integer
     */
    public static function getTime(): int
    {
        return static::$currentTime;
    }

    /**
     * add an observer, part of SplSubject Interface
     *
     * @param SplObserver $observer
     * @return void
     */
    public function attach(SplObserver $observer): void
    {
        static::$observers->attach($observer);
    }

    /**
     * Remove an observer, part of SplSubject Interface
     *
     * @param SplObserver $observer
     * @return void
     */
    public function detach(SplObserver $observer): void
    {
        static::$observers->detach($observer);
    }

    /**
     * Notify all observers of the new time, part of SplSubject Interface
     *
     * @return void
     */
    public function notify(): void
    {
        foreach (static::$observers as $observer) {
            $observer->update(static::$instance);
        }
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
