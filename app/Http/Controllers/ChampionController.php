<?php

namespace App\Http\Controllers;

use App\Models\Champion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChampionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $champion = Champion::create($request->all());
            return $this->sendResponse(["champion" => $champion], "Champion créé avec succès");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::guard('champion-api')->attempt($request->all())) {
                $champion =  Auth::guard('champion-api')->user();
                if ($champion instanceof Champion) {
                    return $this->sendResponse(["user" => $champion, "token" => $champion->createToken("token", ['champion'])->plainTextToken], "User Logged in");
                }
            } else {
                throw new \Exception("Credential invalide");
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 403);
        }
    }

    public function getConnectedUser()
    {
        return $this->sendResponse(["user" => Auth::user()], "Authentification réussie");
    }

    public function logout()
    {
        $champion = Auth::user();
        if ($champion instanceof Champion) {
            $champion->tokens()->delete();
            return $this->sendResponse([], "Utilisateur déconnecté !");
        }
    }
}
