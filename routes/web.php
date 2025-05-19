<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

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
Route::add('GET', '/subscriber/{id}/phones', [Controller\SubscriberController::class, 'viewPhones'])
    ->middleware('auth');

//numbers
Route::add('GET', '/phones', [Controller\PhoneController::class, 'list'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/phones-add', [Controller\PhoneController::class, 'add'])
    ->middleware('auth');
Route::add('POST', '/phone/{id}/attach-subscriber', [Controller\PhoneController::class, 'attachSubscriber'])
    ->middleware('auth');
Route::add(['POST'], '/phone/{id}/detach-subscriber', [Controller\PhoneController::class, 'detachSubscriber'])
    ->middleware('auth');
