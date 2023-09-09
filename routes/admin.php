<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('reset', function (Request $request) {
    defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

    Artisan::call('db:seed --class=PermissionSeeder --force');

    return 'reset success';
});
