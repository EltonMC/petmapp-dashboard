<?php

use App\Http\Middleware\CheckIfAdmin;



// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.



Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('petshop', 'PetshopCrudController');
    CRUD::resource('service', 'ServiceCrudController');
    CRUD::resource('turn', 'TurnCrudController');
    CRUD::resource('reservation', 'ReservationCrudController');
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('phone', 'PhoneCrudController');
    CRUD::resource('address', 'AddressCrudController');
    CRUD::resource('petshopImage', 'PetshopImageCrudController');
}); // this should be the absolute last line of this file