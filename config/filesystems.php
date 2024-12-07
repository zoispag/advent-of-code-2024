<?php

return [
    'default' => env('FILESYSTEM_DISK', 'puzzles'),
    'disks' => [
        'puzzles' => [
            'driver' => 'local',
            'root' => storage_path('puzzles'),
            'visibility' => 'public',
            'serve' => false,
            'throw' => true,
        ],
    ],
];
