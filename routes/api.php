<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

define('TODO_CONTROLLER', 'App\Http\Controllers\TodoController');
define('TODOS', '/todos');
define('TODO_ID', '/todos/{id}');


Route::get(TODOS, [TODO_CONTROLLER, 'index']);
Route::post(TODOS, [TODO_CONTROLLER, 'create']);
Route::put(TODO_ID, [TODO_CONTROLLER, 'update']);
Route::get(TODO_ID, [TODO_CONTROLLER, 'show']);
Route::delete(TODO_ID, [TODO_CONTROLLER, 'destroy']);
