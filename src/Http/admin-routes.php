<?php

Route::group(['middleware' => ['web', 'admin']], function () {

	Route::prefix('admin')->group(function () {

    	Route::view('mediamanager', 'mediamanager::admin.index')->name('admin.mediamanager.index');
    
    	Route::view('mediamanager-popup', 'mediamanager::admin.popup')->name('admin.mediamanager.popup');

    });

});