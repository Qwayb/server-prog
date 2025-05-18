<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/phones', [Controller\Site::class, 'phones'])
    ->middleware('auth');

//divisions
Route::add('GET', '/divisions', [Controller\DivisionController::class, 'list'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/divisions-add', [Controller\DivisionController::class, 'add'])
    ->middleware('auth');;

Route::add('GET', '/divisions-select', [Controller\DivisionController::class, 'selectDivision'])
    ->middleware('auth');
Route::add('GET', '/subscribers/{id}', [Controller\DivisionController::class, 'listSubscribers'])
    ->middleware('auth');

//rooms
Route::add('GET', '/rooms', [Controller\Site::class, 'rooms'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/rooms-add', [Controller\RoomController::class, 'add'])
    ->middleware('auth');

//subscribers
Route::add('GET', '/subscribers', [Controller\SubscriberController::class, 'list'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/subscribers-add', [Controller\SubscriberController::class, 'add'])
    ->middleware('auth');