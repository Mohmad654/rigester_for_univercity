<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
   
    protected $middleware = [
        \App\Http\Middleware\VerifyCsrfToken::class, 
        \App\Http\Middleware\CheckAdmin::class,
      
    ];


    protected $routeMiddleware = [
        'checkadmin' => \App\Http\Middleware\CheckAdmin::class, 
        'auth' => \App\Http\Middleware\Authenticate::class, 
      'checkFinance' => \App\Http\Middleware\CheckFinance::class,

    ];
}
