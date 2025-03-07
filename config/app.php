<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value defines the name of your application. It is used whenever
    | the framework needs to reference the application's name in notifications
    | or in any other place as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value defines the "environment" in which your application is
    | currently operating. It may influence how you configure various
    | services the application uses. Set this value in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debugging
    |--------------------------------------------------------------------------
    |
    | Enabling debug mode in your application will provide detailed error messages
    | and stack traces whenever an error occurs. When disabled, a simple, generic
    | error page will be displayed instead.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application Base URL
    |--------------------------------------------------------------------------
    |
    | This URL is utilized by the console to generate accurate URLs while
    | using Artisan commands. It is essential to set this to the root URL
    | of your application so it can be correctly referenced during Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Default Timezone Configuration
    |--------------------------------------------------------------------------
    |
    | This setting allows you to define the default timezone for your application.
    | It will be used by PHP’s date and time functions. We've set a sensible 
    | default value for your convenience.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Configuration for Application Locale
    |--------------------------------------------------------------------------
    |
    | This setting defines the default locale that will be utilized
    | by the translation service provider. You can set this value
    | to any supported locale for your application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale for the Application
    |--------------------------------------------------------------------------
    |
    | The fallback locale defines the language to be used when the current
    | locale is unavailable. You can modify this value to match any of the
    | language folders available within your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration will determine the locale used by the Faker PHP library
    | when generating fake data for your database seeds. It allows you to generate
    | localized data such as telephone numbers, street addresses, and other
    | region-specific information.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | The key below is utilized by the Illuminate encryption service. It must
    | be set to a random string of 32 characters to ensure that encrypted
    | data remains secure. Make sure to set this before deploying the application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver Configuration
    |--------------------------------------------------------------------------
    |
    | This section allows you to define the driver used to manage Laravel's
    | "maintenance mode" status. Using the "cache" driver enables maintenance
    | mode control across multiple machines or instances.
    |
    | Available drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto-loaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded when
    | your application handles a request. You are welcome to add your own
    | service providers to this array to extend the functionality of
    | your application.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\FortifyServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when the application
    | starts. You are free to register as many aliases as you need, as
    | these aliases are "lazy" loaded, meaning they won't affect the performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];
