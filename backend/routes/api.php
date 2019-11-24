<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register/', 'UsersController@register');
Route::post('login/', 'UsersController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('orders/', 'OrdersController@index');
    Route::post('orders/', 'OrdersController@store');
});

Route::get('products/', 'ProductsController@index');
Route::get('products/{id}', 'ProductsController@show');
