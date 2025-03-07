<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Command Line Routes
|--------------------------------------------------------------------------
|
| This file allows you to define all Closure-based console commands.
| Each Closure is attached to a command instance, providing a simple
| way to interact with the command's input and output methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
