<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return $this->sendResponse(["user" => $user, "token" => $user->createToken("token")->plainTextToken], "Utilisateur créé avec succès");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function getConnectedUser()
    {
        return $this->sendResponse(["user" => Auth::user()], "Authentification réussie");
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user =  Auth::user();
            if ($user instanceof \App\Models\User) {
                if ($user["role"] == 'Admin') {
                    return $this->sendResponse(["user" => $user, "token" => $user->createToken("token", ["personnel", "admin"])->plainTextToken], "Authentification réussie");
                }
                return $this->sendResponse(["user" => $user, "token" => $user->createToken("token", ["personnel"])->plainTextToken], "Authentification réussie");
            }
        }
        return $this->sendError("Credential invalide", 403);
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->tokens()->delete();
            return $this->sendResponse([], "Utilisateur déconnecté !");
        }
    }

    public function getlist()
    {
        return $this->sendResponse(["users" => User::all()], "Liste des personnels");
    }
}
