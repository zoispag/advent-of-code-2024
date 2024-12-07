<?php

use App\Models\Mode;
use Illuminate\Support\Facades\Artisan;

Artisan::command('control {day} {puzzle}', function (int $day, int $puzzle) {
    $class = "\\App\\Models\\Day{$day}Puzzle{$puzzle}";

    $solver = new $class(Mode::Control);

    $this->info("The result is: {$solver->handle()}");
});

Artisan::command('solve {day} {puzzle}', function (int $day, int $puzzle) {
    $class = "\\App\\Models\\Day{$day}Puzzle{$puzzle}";

    $solver = new $class(Mode::Puzzle);

    $this->info("The result is: {$solver->handle()}");
});
