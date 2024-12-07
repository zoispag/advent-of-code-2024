<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

abstract class Puzzle
{
    public function __construct(
        readonly public Mode $mode = Mode::Puzzle,
    ) {}

    public static function name(): string
    {
        $solver = str(new \ReflectionClass(static::class)->getShortName());
        $day = $solver->between('Day', 'Puzzle');
        $puzzle = $solver->after('Puzzle');

        return "Day {$day}: Puzzle #{$puzzle}";
    }

    protected function getInput(): mixed
    {
        $puzzle = new \ReflectionClass($this)->getShortName();

        return $this->parseInput(
            Storage::get("{$puzzle}/{$this->mode->value}.txt")
        );
    }

    abstract public function handle(): mixed;

    abstract protected function parseInput(string $input): mixed;
}
