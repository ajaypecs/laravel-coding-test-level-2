<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::middleware(['auth:sanctum', 'abilities:users'])->group(function(){
    Route::patch('project/{project_id}', [TaskController::class, 'updateTask']);
});

Route::prefix('vi')->middleware(['auth:sanctum', 'abilities:admin'])->group(function(){
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user_id}', [UserController::class, 'userId']);
Route::post('users', [UserController::class, 'create']);
Route::put('users/{user_id}', [UserController::class, 'update']);
Route::patch('users/{user_id}', [UserController::class, 'updateUser']);
Route::delete('delete/{user_id}', [UserController::class, 'delete']);
Route::delete('delete-users/{users_id}', [UserController::class, 'deleteUsers']);

});

Route::prefix('owner')->middleware(['auth:sanctum', 'abilities:owner'])->group(function(){
    Route::post('create-project', [ProjectController::class, 'create']);
    Route::post('create-task', [TaskController::class, 'create']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('admin-login', [AdminController::class, 'login']);
Route::post('owner-login', [OwnerController::class, 'login']);



