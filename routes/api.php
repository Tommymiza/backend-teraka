<?php

use App\Http\Controllers\ChampionController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\PetitGroupeController;
use App\Http\Controllers\PrePetitGroupeController;
use App\Http\Controllers\QuantificateurController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
        Route::delete('/membre/{id}', [MembreController::class, 'destroy']);
    });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function () {
        Route::get("/all", [ChampionController::class, "getAll"]);
        Route::post("/add", [ChampionController::class, "store"]);
        Route::put('/put/{id}', [ChampionController::class, 'update']);
        Route::delete('/delete/{id}', [ChampionController::class, 'delete']);
    });
});

/* ######-ROUTE QUANTIFICATEUR-###### */

Route::prefix('quantificateur')->group(function () {
    // Route::post('/login', [ChampionController::class, 'login']);
    // Route::middleware(["auth:sanctum", "abilities:champion"])->group(function () {
    //     Route::get("/check", [ChampionController::class, "getConnectedUser"]);
    //     Route::get('/logout', [ChampionController::class, 'logout']);
    //     Route::delete('/membre/{id}', [MembreController::class, 'destroy']);
    // });
    Route::middleware(["auth:sanctum", "abilities:personnel"])->group(function () {
        Route::get("/all", [QuantificateurController::class, "getAll"]);
        Route::post("/add", [QuantificateurController::class, "store"]);
        Route::put('/put/{id}', [QuantificateurController::class, 'update']);
        Route::delete('/delete/{id}', [QuantificateurController::class, 'delete']);
    });
});
Route::get('/storage/{file}', function ($file) {
    // Vérifier si le fichier existe dans le dossier "storage"
    if (Storage::exists($file)) {
        // Récupérer le contenu du fichier et le retourner comme réponse
        return Storage::get($file);
    } else {
        // Si le fichier n'existe pas, retourner une réponse appropriée (par exemple 404 Not Found)
        return response()->json(['message' => 'File not found.'], 404);
    }
});

/* ######-ROUTE PETIT GROUPE-###### */
Route::prefix('petit-groupe')->group(function () {
    Route::middleware(['auth:sanctum', 'ability:champion,personnel,admin'])->group(function () {
        Route::post('/add', [PetitGroupeController::class, "store"]);
        Route::post("/add-member", [MembreController::class, "store"]);
        Route::get("/all", [PetitGroupeController::class, "index"]);
        Route::get("/all-champion/{id}", [PetitGroupeController::class, "getAllFromChampion"]);
        Route::get("/all-members/{id}", [PetitGroupeController::class, "getAllMember"]);
    });
    Route::middleware(["auth:sanctum", "ability:personnel, admin"])->group(function () {
        Route::delete("/delete/{id}", [PetitGroupeController::class, "destroy"]);
        Route::get("/{id}", [PetitGroupeController::class, "show"]);
        Route::put("/check/{id}", [PetitGroupeController::class, "validated"]);
    });
});

/* ######-ROUTE OTHER-###### */
Route::post('/jointeraka', [PrePetitGroupeController::class, 'store']);
