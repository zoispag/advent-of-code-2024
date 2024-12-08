<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day5Puzzle1 extends Puzzle
{
    public function handle(): int
    {
        /** @var Collection $orderingRules */
        /** @var Collection $printUpdates */
        [$orderingRules, $printUpdates] = $this->getInput();

        return $printUpdates
            ->filter(fn (Collection $update) => $this->isValidUpdate($update, $orderingRules))
            ->map(fn (Collection $update) => $update->get(floor($update->count() / 2)))
            ->sum();
    }

    protected function parseInput(string $input): array
    {
        [$rules, $updates] = str($input)->explode(PHP_EOL.PHP_EOL);

        $orderingRules = str($rules)
            ->trim()
            ->explode(PHP_EOL)
            ->filter()
            ->map(fn ($rule) => array_combine(
                ['before', 'after'],
                str($rule)->explode('|')->toArray(),
            ));

        $printUpdates = str($updates)
            ->trim()
            ->explode(PHP_EOL)
            ->map(fn ($update) => str($update)->explode(','));

        return [$orderingRules, $printUpdates];
    }

    protected function isValidUpdate(Collection $update, Collection $orderingRules): bool
    {
        foreach ($update as $index => $page) {
            $beforeRules = $orderingRules
                ->groupBy('after')
                ->get($page)?->map?->before ?? collect([]);

            $breaksRule = $update->slice($index)
                ->filter(fn ($afterPage) => $beforeRules->contains($afterPage))
                ->isNotEmpty();

            if ($breaksRule) {
                return false;
            }
        }

        return true;
    }
}
