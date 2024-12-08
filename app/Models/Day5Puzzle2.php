<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day5Puzzle2 extends Day5Puzzle1
{
    public function handle(): int
    {
        /** @var Collection $orderingRules */
        /** @var Collection $printUpdates */
        [$orderingRules, $printUpdates] = $this->getInput();

        return $printUpdates
            ->reject(fn (Collection $update) => $this->isValidUpdate($update, $orderingRules))
            ->map(fn (Collection $update) => $this->fixUpdateOrder($update, $orderingRules))
            ->map(fn (Collection $update) => $update->get(floor($update->count() / 2)))
            ->sum();
    }

    private function fixUpdateOrder(Collection $update, mixed $orderingRules): Collection
    {
        return $update->sort(function ($a, $b) use ($orderingRules) {
             $beforeRules = $orderingRules
                ->groupBy('after')
                ->get($a)?->map?->before ?? collect([]);

             return $beforeRules->contains($b) ? 1 : -1;
        })->values();
    }
}
