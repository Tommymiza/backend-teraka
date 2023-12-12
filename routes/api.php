<?php

use App\Http\Controllers\ChampionController;
use App\Http\Controllers\PetitGroupeController;
use App\Http\Controllers\PrePetitGroupeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware(["auth:sanctum", "abilities:personnel,admin"])->group(function () {
        Route::post('/add', [UserController::class, 'store']);
    });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function () {
        Route::get("/check", [UserController::class, "getConnectedUser"]);
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get("/all", [UserController::class, "getlist"]);
    });
});

Route::prefix('petit-groupe')->group(function () {
    Route::middleware(['auth:sanctum', 'ability:champion'])->group(function () {
        Route::post('/add', [PetitGroupeController::class, "store"]);
    });
});

Route::prefix('champion')->group(function () {
    Route::post('/login', [ChampionController::class, 'login']);
    Route::middleware(["auth:sanctum", "abilities:champion"])->group(function () {
        Route::get("/check", [ChampionController::class, "getConnectedUser"]);
        Route::get('/logout', [ChampionController::class, 'logout']);
    });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function () {
        Route::get("/all", [ChampionController::class, "getlist"]);
        Route::post("/add", [ChampionController::class, "store"]);
    });
});
Route::post('/jointeraka', [PrePetitGroupeController::class, 'store']);
