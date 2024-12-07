<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day3Puzzle2 extends Day3Puzzle1
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
        $donts = str($input)
            ->explode("don't()");

        $dos = $donts->slice(1)
            ->flatMap(fn ($dont) => str($dont)
                ->explode('do()')
                ->reject(fn ($dont, $index) => $index === 0)
            )
            ->prepend($donts->first())
            ->join('');

        return $this->matchPattern($dos);
    }
}
