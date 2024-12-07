<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day1Puzzle1 extends Puzzle
{
    public function handle(): int
    {
        /** @var Collection $columnA */
        /** @var Collection $columnB */
        [$columnA, $columnB] = $this->getInput();

        return $columnA
            ->map(fn ($value, $key) => abs($value - $columnB[$key]))
            ->sum();
    }

    protected function parseInput(string $input): array
    {
        $columns = collect(explode(PHP_EOL, $input))
            ->filter()
            ->map(fn ($line) => str($line)->explode('   '))
            ->toArray();

        $columnA = collect(array_column($columns, 0))->sort()->values();
        $columnB = collect(array_column($columns, 1))->sort()->values();

        return [$columnA, $columnB];
    }
}
