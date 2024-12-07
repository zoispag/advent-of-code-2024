<?php

use App\Models;
use App\Models\Mode;
use App\Models\Puzzle;

it('will solve the puzzles', function (
    /** @var class-string<Puzzle> $solver */
    string $solver,
    mixed $expectedResult,
) {
    expect(new $solver(Mode::Control)->handle())->toBe($expectedResult);
})->with([
    Models\Day1Puzzle1::name() => [Models\Day1Puzzle1::class, 11],
    Models\Day1Puzzle2::name() => [Models\Day1Puzzle2::class, 31],
    Models\Day2Puzzle1::name() => [Models\Day2Puzzle1::class, 2],
    Models\Day2Puzzle2::name() => [Models\Day2Puzzle2::class, 4],
    Models\Day3Puzzle1::name() => [Models\Day3Puzzle1::class, 161],
    Models\Day3Puzzle2::name() => [Models\Day3Puzzle2::class, 48],
]);
