<?php

declare(strict_types=1);

namespace App\module6;

use SplObserver;

/**
* Observer,that who receives news
*/
class TimeObserver implements SplObserver
{
    public function update(int $newTime): void
    {
        // new time received
    }
}
