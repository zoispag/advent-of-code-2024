<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day1Puzzle2 extends Day1Puzzle1
{
    public function handle(): int
    {
        /** @var Collection $columnA */
        /** @var Collection $columnB */
        [$columnA, $columnB] = $this->getInput();

        return $columnA
            ->map(fn ($value, $key) => $value * $columnB->filter(fn ($v) => $v == $value)->count())
            ->sum();
    }
}
