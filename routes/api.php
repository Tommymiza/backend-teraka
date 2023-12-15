<?php

use App\Http\Controllers\ChampionController;
use App\Http\Controllers\PetitGroupeController;
use App\Http\Controllers\PrePetitGroupeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* ######-ROUTE PERSONNEL-###### */
Route::prefix('user')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware(["auth:sanctum", "abilities:personnel,admin"])->group(function () {
        Route::post('/add', [UserController::class, 'store']);
        Route::put('/put/{id}', [UserController::class, 'update']);
        Route::delete('/delete/{id}', [UserController::class, 'delete']);
    });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function () {
        Route::get("/check", [UserController::class, "getConnectedUser"]);
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get("/all", [UserController::class, "getlist"]);
    });
});

/* ######-ROUTE CHAMPION-###### */
Route::prefix('champion')->group(function () {
    Route::post('/login', [ChampionController::class, 'login']);
    Route::middleware(["auth:sanctum", "abilities:champion"])->group(function () {
        Route::get("/check", [ChampionController::class, "getConnectedUser"]);
        Route::get('/logout', [ChampionController::class, 'logout']);
    });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function () {
        Route::get("/all", [ChampionController::class, "getAll"]);
        Route::post("/add", [ChampionController::class, "store"]);
        Route::put('/put/{id}', [ChampionController::class, 'update']);
        Route::delete('/delete/{id}', [ChampionController::class, 'delete']);
    });
});

/* ######-ROUTE PETIT GROUPE-###### */
Route::prefix('petit-groupe')->group(function () {
    Route::middleware(['auth:sanctum', 'ability:champion'])->group(function () {
        Route::post('/add', [PetitGroupeController::class, "store"]);
    });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function (){
        Route::get("/all", [PetitGroupeController::class, "getAll"]);
    });
});

/* ######-ROUTE OTHER-###### */
Route::post('/jointeraka', [PrePetitGroupeController::class, 'store']);
