<?php

// /routes/web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController; // Laravel's default
use App\Http\Controllers\Admin\UserController; // Our new Admin controller

/*
|--------------------------------------------------------------------------
| Guest & Authentication Routes
|--------------------------------------------------------------------------
| Routes accessible to unauthenticated users (login, password reset).
| Registration is DISABLED via the Auth::routes() array.
*/

// Smart Root Route: Redirects to login if guest, or home if authenticated.
Route::get('/', function () {
    // Note: We use Auth::check() here to keep it simple,
    // but the LoginController ensures only 'super_admin' role can log in.
    return Auth::check() ? redirect('/home') : redirect('/login');
});

// Auth scaffolding routes: Login, Logout, Password Reset.
Auth::routes(['register' => false]);


/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Base Access)
|--------------------------------------------------------------------------
| Routes available to any user who is successfully authenticated.
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Route (The first page after successful login)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});


/*
|--------------------------------------------------------------------------
| Super Admin Protected Routes (Backend Management)
|--------------------------------------------------------------------------
| These routes require both authentication AND the 'super_admin' role.
| This is the highest level of security for the administrative section.
*/
Route::middleware(['auth', 'is_super_admin'])->prefix('admin')->name('admin.')->group(function () {

    // User Management CRUD
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Future: Create, Edit, Settings, etc. will go here.
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
