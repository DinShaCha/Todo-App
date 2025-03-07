<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Verify If The Application Is In Maintenance Mode
|--------------------------------------------------------------------------
|
| When the application is in maintenance or demo mode, activated by the "down" command,
| this file will be loaded to show pre-rendered content instead of initializing
| the framework, which could result in an error.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides an automatically generated class loader for this
| application. By including it here, we can avoid manually loading
| our classes. This is all handled for us automatically!
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Start The Application
|--------------------------------------------------------------------------
|
| With the application set up, we can now process the incoming requests using
| the application's HTTP kernel. Once the response is generated, it will be 
| sent back to the client's browser, allowing them to interact with the application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
