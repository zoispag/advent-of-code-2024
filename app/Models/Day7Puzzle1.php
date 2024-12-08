<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Day7Puzzle1 extends Puzzle
{
    public function handle(): int
    {
        $equations = $this->getInput();

        return $equations
            ->filter(fn ($equation) => $this->evaluateEquation($equation))
            ->map(fn ($equation) => $equation['result'])
            ->sum();
    }

    protected function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->filter()
            ->map(function ($line) {
                [$res, $parts] = str($line)->explode(':');
                $parts = str($parts)->trim()
                    ->explode(' ')
                    ->map(fn ($part) => (int) $part)
                    ->toArray();

                return ['result' => (int) $res, 'parts' => $parts];
            });
    }

    protected function evaluateEquation(array $equation): bool
    {
        $paths = collect([]);

        foreach ($equation['parts'] as $part) {
            if ($paths->isEmpty()) {
                $paths->push($part);
                continue;
            }

            $paths = $paths->flatMap(fn ($path) => [
                $path + $part,
                $path * $part
            ]);
        }

        return $paths->contains($equation['result']);
    }
}
