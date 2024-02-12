<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\Quantificateur;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuantificateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $password = substr(md5(time()), 0, 8);
            $data = $request->all();
            $exist = Quantificateur::where('email', $data['email'])->first();
            if ($exist) {
                throw new Error("1062");
            }
            Mail::to($data['email'])->send(new SendPassword($password, "Quantificateur"));
            $data['password'] = $password;
            $user = Quantificateur::create($data);
            return $this->sendResponse(["user" => $user], "Quantificateur créé avec succès");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quantificateur $quantificateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = Quantificateur::findOrfail($id);
            $user->update($request->all());
            return $this->sendResponse(["user" => $user], "Quantificateur modifié avec succès");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function getAll()
    {
        return $this->sendResponse(['all' => Quantificateur::all()], "Succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $user = Quantificateur::findOrfail($id);
            $user->delete();
            return $this->sendResponse(["user" => $user], "Quantificateur supprimé avec succès");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
