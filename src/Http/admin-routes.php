<?php

Route::group(['middleware' => ['web', 'admin']], function () {

	Route::prefix('admin')->group(function () {

    	Route::view('mediamanager', 'mediamanager::admin.mediamanager.index')->name('admin.mediamanager.index');
    
    	Route::view('mediamanager-popup', 'mediamanager::admin.mediamanager.popup')->name('admin.mediamanager.popup');

    });

});