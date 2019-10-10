<?php

declare(strict_types=1);

namespace App\module3;

final class Clock
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
     * @var Clock
     */
    private static $instance = null;


    /**
     * @param integer $endTime
     * @return Clock
     */
    public static function time(int $endTime): Clock
    {
        if (null === static::$instance) {
            static::$instance = new static();
            static::$endOfTime = $endTime;
            static::$currentTime = 0;
        }

        return static::$instance;
    }

    /**
     * @return void
     */
    public static function run(): void
    {
        if (static::$currentTime < static::$endOfTime) {
            static::$currentTime++;
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
