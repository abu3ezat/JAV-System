<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
});
Route::post('submit' , [\App\Http\Controllers\RecordController::class , 'submit']);
Route::get('create' , [\App\Http\Controllers\RecordController::class , 'create']);
Route::get('show' , [\App\Http\Controllers\RecordController::class, 'show']);
Route::delete('delete', 'RecordsController@massDestroy')->name('delete');
Route::get('recorddelete/{id}', [\App\Http\Controllers\RecordController::class, 'delete']);



//Route::get('pendingmove/{id}', [
//    'as' => 'test',
//    'uses' => 'PendingController',
//]);

Route::get('/pendingdelete/{id}' , [\App\Http\Controllers\PendingController::class , 'delete']);
Route::get('/pendingaccept/{id}', [\App\Http\Controllers\PendingController::class, 'move']);
Route::post('pendingsubmit' , [\App\Http\Controllers\PendingController::class , 'pendingsubmit']);
Route::get('pendingshow' , [\App\Http\Controllers\PendingController::class, 'pendingshow']);

Route::get('createcoupon' , [\App\Http\Controllers\CouponsController::class, 'index']);
Route::post('/coupon' , 'CouponsController@store')->name('coupon.store');
Route::get('coupondelete/{id}', [\App\Http\Controllers\CouponsController::class , 'delete']);

Route::get('couponshow' , [\App\Http\Controllers\CouponsController::class , 'show']);

Route::post('couponsubmit/{id}', [\App\Http\Controllers\CouponsController::class , 'couponsub']);
Route::get('couponsubmit/{id}', [\App\Http\Controllers\CouponsController::class , 'couponsub']);

Route::get('noti', [\App\Http\Controllers\PendingController::class , 'notify']);

Route::post('/test' , 'TestController@store')->name('test.store');
Route::delete('/test' , 'TestController@destroy')->name('test.destroy');
