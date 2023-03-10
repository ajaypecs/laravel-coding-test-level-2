<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('vi')->group(function(){

Route::get('users', [UserController::class, 'index']);
Route::get('users/{user_id}', [UserController::class, 'userId']);
Route::post('users', [UserController::class, 'create']);
Route::put('update/{user_id}', [UserController::class, 'update']);
Route::patch('update-user/{user_id}', [UserController::class, 'updateUser']);
Route::delete('delete-user/{user_id}', [UserController::class, 'delete']);
Route::delete('delete-users/{users_id}', [UserController::class, 'deleteUsers']);


Route::post('create-project', [ProjectController::class, 'create']);
Route::post('create-task', [TaskController::class, 'create']);

});