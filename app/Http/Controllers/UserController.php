<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $password = substr(md5(time()), 0, 8);
            $data = $request->all();
            $exist = User::where('email', $data['email'])->first();
            if ($exist) {
                throw new Error("1062");
            }
            Mail::to($data['email'])->send(new SendPassword($password, "Personnel"));
            $data['password'] = $password;
            $user = User::create($data);
            return $this->sendResponse(["user" => $user], "Utilisateur créé avec succès");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrfail($id);
            $user->update($request->all());
            return $this->sendResponse(["user" => $user], "Utilisateur modifié avec succès");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $user = User::findOrfail($id);
            $user->delete();
            return $this->sendResponse(["user" => $user], "Utilisateur supprimé avec succès");
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
