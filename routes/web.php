<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard',[TasksController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

// ログイン画面
Route::middleware('auth')->group(function () {
    //tasks
    Route::resource('tasks',TasksController::class);
});

require __DIR__.'/auth.php';
