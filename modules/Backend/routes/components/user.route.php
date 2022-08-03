<?php
/**
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://github.com/juzaweb/juzacms
 * @license    GNU V2
 */

use Juzaweb\Backend\Http\Controllers\Backend\ProfileController;
use Juzaweb\Backend\Http\Controllers\Backend\RoleController;
use Juzaweb\Backend\Http\Controllers\Backend\UserController;

Route::jwResource('users', UserController::class);

Route::jwResource('roles', RoleController::class);

Route::group(
    ['prefix' => 'profile'],
    function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('/', [ProfileController::class, 'update']);
    }
);
