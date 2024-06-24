<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);
// admin
Route::post('admin/login',[AdminController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('store',[UserController::class, 'store']);
    Route::post('fetch',[UserController::class, 'fetch']);
    Route::post('delete',[UserController::class, 'delete']);
    Route::post('permission',[UserController::class, 'permission']);
    Route::post('title',[UserController::class, 'title']);
    Route::post('title',[UserController::class, 'title']);
    Route::post('fetchTitle',[UserController::class, 'fetchTitle']);
    Route::post('deleteTitle',[UserController::class, 'deleteTitle']);
    Route::post('fetchNotes',[UserController::class, 'fetchNotes']);
    Route::post('noteSave',[UserController::class, 'noteSave']);
    Route::post('noteDelete',[UserController::class, 'noteDelete']);
    Route::post('noteUpdate',[UserController::class, 'noteUpdate']);
    Route::post('logout',[UserController::class, 'logout']);

    // admin
    Route::post('admin/allUser',[AdminController::class, 'allUser']);
    Route::post('admin/readPermission',[AdminController::class, 'readPermission']);
    Route::post('admin/writePermission',[AdminController::class, 'writePermission']);
    Route::post('admin/editPermission',[AdminController::class, 'editPermission']);
    Route::post('admin/deletePermission',[AdminController::class, 'deletePermission']);
    Route::post('admin/addNewUser',[AdminController::class, 'addNewUser']);
    Route::post('admin/userdelete',[AdminController::class, 'userdelete']);
    Route::post('admin/userUpdate',[AdminController::class, 'userUpdate']);
    
    
});
