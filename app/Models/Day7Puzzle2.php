<?php

namespace App\Models;

class Day7Puzzle2 extends Day7Puzzle1
{
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
                $path * $part,
                (int) ($path . $part),
            ]);
        }

        return $paths->contains($equation['result']);
    }
}
