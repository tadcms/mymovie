<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

use Juzaweb\CMS\Support\Route\Auth;
use Juzaweb\Backend\Http\Controllers\AdminController;
use Juzaweb\Backend\Http\Controllers\DatabaseController;
use Juzaweb\Backend\Http\Controllers\EnvironmentController;
use Juzaweb\Backend\Http\Controllers\FinalController;
use Juzaweb\Backend\Http\Controllers\PermissionsController;
use Juzaweb\Backend\Http\Controllers\RequirementsController;
use Juzaweb\Backend\Http\Controllers\WelcomeController;

Route::group(
    [
        'prefix' => 'install',
        'middleware' => 'install',
    ],
    function () {
        Route::get('/', [WelcomeController::class, 'welcome'])->name('installer.welcome');
        Route::get('environment', [EnvironmentController::class, 'environment'])->name('installer.environment');
        
        Route::post('environment', [EnvironmentController::class, 'save'])->name('installer.environment.save');
        
        Route::get('requirements', [RequirementsController::class, 'requirements'])->name('installer.requirements');
        
        Route::get('permissions', [PermissionsController::class, 'permissions'])->name('installer.permissions');
        
        Route::get('database', [DatabaseController::class, 'database'])->name('installer.database');
        
        Route::get('admin', [AdminController::class, 'index'])->name('installer.admin');
        
        Route::post('admin', [AdminController::class, 'save'])->name('installer.admin.save');
        
        Route::get('final', [FinalController::class, 'finish'])->name('installer.finish');
    }
);

Route::group(
    [
        'middleware' => 'guest',
        'as' => 'admin.',
        'prefix' => config('juzaweb.admin_prefix'),
        'namespace' => 'Juzaweb\CMS\Http\Controllers',
    ],
    function () {
        Auth::routes();
    }
);