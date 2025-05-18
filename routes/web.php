<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/subscribers', [Controller\Site::class, 'subscribers'])
    ->middleware('auth');
Route::add('GET', '/rooms', [Controller\Site::class, 'rooms'])
    ->middleware('auth');
Route::add('GET', '/phones', [Controller\Site::class, 'phones'])
    ->middleware('auth');

Route::add('GET', '/divisions', [Controller\DivisionController::class, 'list'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/divisions-add', [Controller\DivisionController::class, 'add'])
    ->middleware('auth');;
