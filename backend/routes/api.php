<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::prefix("/task")->group(function () {
    Route::post("/", [TaskController::class, "create"]);
    Route::get("/", [TaskController::class, "get"]);
});
Route::get("/leaderboard", [UserController::class, "leaderboard"]);
