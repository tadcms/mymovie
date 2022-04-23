<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

use Juzaweb\Backend\Http\Controllers\API\Auth\LoginController;

Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::post('login', [LoginController::class, 'login']);
    }
);

Route::group(
    [
        'prefix' => 'auth',
        'middleware' => 'auth:sanctum',
    ],
    function () {
        Route::post('logout', [LoginController::class, 'logout']);
        Route::get('me', [LoginController::class, 'me']);
    }
);