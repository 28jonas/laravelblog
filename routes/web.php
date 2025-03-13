<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*frontend routes*/

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');




/*Backend routes*/

Route::get('/roles', function () {
    /*return view('backend.roles.index');)*/
});

//zelfde als route prefix hieronder
/*Route::middleware(['auth'])->group(function () {
    Route::resource('/backend/users', UserController::class);

});*/

Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'admin', 'verified']], function (){
    Route::resource('/users', UserController::class);
    Route::patch('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::resource('/categories', CategoryController::class);
    Route::patch('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{id}/forceDelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    /*orders*/
    Route::resource('/orders', OrderController::class);

    /*Products*/
    Route::resource('/products', ProductController::class);

    //notification route
    Route::patch('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back()->with('message', 'Notification marked as read.');
    })->name('notifications.markAsRead');
});



Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified']], function (){
    Route::resource('/posts', PostController::class)->scoped(['post' => 'slug']);
});


Route::get('/backend', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('backend.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
