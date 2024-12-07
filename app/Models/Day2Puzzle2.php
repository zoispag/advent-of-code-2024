<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day2Puzzle2 extends Day2Puzzle1
{
    public function handle(): int
    {
        /** @var Collection $levels */
        $levels = $this->getInput();

        return $levels
            ->filter(function (Collection $level) {
                if ($this->isLevelSafe($level)) {
                    return true;
                }

                for ($i = 0; $i < $level->count(); $i++) {
                    $newLevel = $level->reject(fn ($v, $index) => $index === $i)->values();

                    if ($this->isLevelSafe($newLevel)) {
                        return true;
                    }
                }

                return false;
            })->count();
    }
}
