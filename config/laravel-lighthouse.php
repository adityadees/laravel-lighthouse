<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Node
    |--------------------------------------------------------------------------
    |
    | Target node path
    | run `which node in your terminal to check your node path`
    | example :
    | 'node' => '/opt/homebrew/bin/node',
    |
    */
    'node' => '',

    /*
    |--------------------------------------------------------------------------
    | Lighthouse
    |--------------------------------------------------------------------------
    |
    | Target lighthouse path
    | This option to target your lighthouse cli
    | You can check it on your node_modules directory
    | you can use the path from local or global instalation
    | example :
    | 'lighthouse' => '/opt/homebrew/lib/node_modules/lighthouse/cli',
    |
    */
    'lighthouse' => '',


    /*
    |--------------------------------------------------------------------------
    | Output
    |--------------------------------------------------------------------------
    |
    | Target output path
    | This option to target your output file
    | example : 'output' => base_path() . '/public/laravel-lighthouse',
    |
    */

    'output' => '',


    /*
    |--------------------------------------------------------------------------
    | Url
    |--------------------------------------------------------------------------
    |
    | Target default target url
    | This option to target your url
    | 'url' => 'https://adityadees.com',
    |
    */

    'url' => '',


    /*
    |--------------------------------------------------------------------------
    | Process Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before the process will be
    | considered unsuccessful.
    | default is 1 minutes
    |
    */
    'timeout' => 60,

    /*
    |--------------------------------------------------------------------------
    | Custom Flag
    |--------------------------------------------------------------------------
    |
    | You can set your own flag configuration
    | For a full list of flags, see https://github.com/GoogleChrome/lighthouse
    | example:
    | 'mobile' => ' --chrome-flags="--headless --no-sandbox --disable-gpu" --output html --output json --output-path ' . base_path() . '/public/laravel-lighthouse/mobile/result.html',
    | 'desktop' => ' --chrome-flags="--headless --no-sandbox --disable-gpu" --preset=desktop --output html --output json --output-path ' . base_path() . '/public/laravel-lighthouse/desktop/result.html',
    */
    'flag' => [
        'mobile' => '',
        'desktop' => '',
    ],
];
