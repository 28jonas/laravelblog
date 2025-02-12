<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/roles', function () {
    /*return view('backend.roles.index');)*/
});

//zelfde als route prefix hieronder
/*Route::middleware(['auth'])->group(function () {
    Route::resource('/backend/users', UserController::class);

});*/

Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function (){
    Route::resource('/users', UserController::class);
});


Route::get('/backend', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('backendindex');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
