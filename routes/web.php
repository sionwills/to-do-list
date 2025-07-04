<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/update{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::post('/delete{id}', [TaskController::class, 'delete'])->name('tasks.delete');
