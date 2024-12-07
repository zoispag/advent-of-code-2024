<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day3Puzzle1 extends Puzzle
{
    public function handle(): int
    {
        $multiplications = $this->getInput();

        return $multiplications
            ->map(fn ($nums) => $nums[0] * $nums[1])
            ->sum();
    }

    protected function parseInput(string $input): Collection
    {
        return $this->matchPattern($input);
    }

    protected function matchPattern(string $input): Collection
    {
        preg_match_all('/mul\((\d+,\d+)\)/', $input, $matches);

        return collect($matches[1])
            ->map(fn ($s) => str($s)->explode(','));
    }
}
