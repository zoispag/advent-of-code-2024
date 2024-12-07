<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day2Puzzle1 extends Puzzle
{
    public function handle(): int
    {
        /** @var Collection $levels */
        $levels = $this->getInput();

        return $levels->filter(
            fn (Collection $level) => $this->isLevelSafe($level)
        )->count();
    }

    protected function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->filter()
            ->map(fn ($line) => str($line)->explode(' '));
    }

    protected function isLevelSafe(Collection $level): bool
    {
        // Unsafe because there's neither an increase nor a decrease.
        if ($level->unique()->count() !== $level->count()) {
            return false;
        }

        // Unsafe because while some are increasing, at least one is decreasing, or
        // because while some are decreasing, at least one is increasing.
        $sorted = $level->sort()->values()->toJson();
        $reverse = $level->sort()->reverse()->values()->toJson();
        if ($sorted !== $level->toJson() && $reverse !== $level->toJson()) {
            return false;
        }

        // Unsafe because any two adjacent levels differ by either less than one or more than three.
        $adjacentDiffs = $level->sliding(2)
            ->map(function (Collection $neighbours) {
                [$x, $y] = $neighbours->values();

                return abs($x - $y);
            });

        $invalidAdjacentDiffs = $adjacentDiffs->filter(
            fn ($diff) => $diff < 1 || $diff > 3
        );

        if ($invalidAdjacentDiffs->isNotEmpty()) {
            return false;
        }

        return true;
    }
}
