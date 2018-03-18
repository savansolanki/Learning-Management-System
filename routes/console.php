<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('docs', function () {
    $this->call('clear-compiled');
    $this->call('ide-helper:generate', [
        '-H' => true,
    ]);
    $this->call('ide-helper:models', [
        '-W' => true,
        '-R' => true,
    ]);
    $this->call('ide-helper:meta');
    $this->call('optimize');
})->describe('Generate Laravel IDE-Helper Docs');