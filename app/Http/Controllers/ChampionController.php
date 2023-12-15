<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\Champion;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ChampionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $password = substr(md5(time()), 0, 8);
            $data = $request->all();
            $exist = Champion::where('email', $data['email'])->first();
            if ($exist) {
                throw new Error("1062");
            }
            Mail::to($data['email'])->send(new SendPassword($password, "Champion"));
            $data['password'] = $password;
            $user = Champion::create($data);
            return $this->sendResponse(["user" => $user], "Champion créé avec succès");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = Champion::findOrfail($id);
            $user->update($request->all());
            return $this->sendResponse(["user" => $user], "Champion modifié avec succès");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = Champion::findOrfail($id);
            $user->delete();
            return $this->sendResponse(["user" => $user], "Champion supprimé avec succès");
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

    public function getAll()
    {
        return $this->sendResponse(['all' => Champion::all()], "Succès");
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
