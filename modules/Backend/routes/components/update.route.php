<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

Route::group(
    ['prefix' => 'updates'],
    function () {
        Route::get('/', 'Backend\UpdateController@index')->name('admin.update');
        Route::get('check-update', 'Backend\UpdateController@checkUpdate')->name('admin.update.check');

        Route::get('get-plugins', 'Backend\UpdateController@pluginDatatable')->name('admin.update.plugins');
        Route::get('get-themes', 'Backend\UpdateController@themeDatatable')->name('admin.update.themes');
    }
);

Route::get('update/{type}/{step}', 'Backend\UpdateController@update')
    ->where('step', '[0-9]+')->name('admin.update.step');