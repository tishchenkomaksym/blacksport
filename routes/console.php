<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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

Artisan::command('storage:docs', function () {

    if (file_exists(public_path('docs/api-docs.json'))) {
        return $this->error('The "docs" directory already exists.');
    }

    $this->laravel->make('files')->link(
        storage_path('api-docs/api-docs.json'), public_path('docs/api-docs.json')
    );
    $this->info('Symbolic link for docs created');
})->describe('Create symbolic link for docs');
