<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/news')->group(function () {

    Route::get('/list', [
        'uses' => 'App\Http\Controllers\Api\NewsController@getNewsList'
    ]);


});

