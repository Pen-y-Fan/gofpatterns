<?php

declare(strict_types=1);

namespace App\module6;

use SplObserver;
use SplSubject;

/**
* Observer,that who receives news
*/
class TimeObserver implements SplObserver
{
    public function update(SplSubject $SplSubject): void
    {
        // new time received
    }
}
