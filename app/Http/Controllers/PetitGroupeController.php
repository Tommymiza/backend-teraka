<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Petitgroupe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PetitGroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(['all' => Petitgroupe::all()], "Succès");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $photo_pg = $request->file('photo_pg');
            $pathPhoto = $photo_pg->store('pg', 'public');
            $photo_pepiniere = '';
            $photo_arbre = '';
            if ($request->file('files') != null) {
                for ($i = 0; $i < count($request->file('files')); $i++) {
                    $path = $request->file('files')[$i]->store('pepiniere', 'public');
                    if ($i == 0) {
                        $photo_pepiniere = $path;
                    } else {
                        $photo_pepiniere = $photo_pepiniere . ';' . $path;
                    }
                }
            }
            if ($request->file('files2') != null) {
                $photo_arbre = '';
                for ($i = 0; $i < count($request->file('files2')); $i++) {
                    $path = $request->file('files2')[$i]->store('arbre', 'public');
                    if ($i == 0) {
                        $photo_arbre = $path;
                    } else {
                        $photo_arbre = $photo_arbre . ';' . $path;
                    }
                }
            }
            $data['photo_pepiniere'] = $photo_pepiniere;
            $data['photo_arbre'] = $photo_arbre;
            $data['photo_pg'] = $pathPhoto;
            Petitgroupe::create($data);
            return $this->sendResponse([], "Ajout réussi");
        } catch (Exception $e) {
            Log::error($e);
            return $this->sendError($e->getMessage(), 403);
        }
    }
    /**
     * Display the specified resource.
     */
    public function getAllFromChampion($id)
    {
        return $this->sendResponse(['all' => Petitgroupe::all()->where('id_champion', '==', $id)], "Succès");
    }
    public function getAllMember($id)
    {
        return $this->sendResponse(['all' => Membre::all()->where('id_pg', '==', $id)], "Succès");
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PetitGroupe $petitGroupe)
    {
        //
    }
    public function show($id)
    {
        try {
            $pg = Petitgroupe::findOrfail($id);
            $pg->membres;
            return $this->sendResponse($pg, "Succès");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function validated(Request $request, $id)
    {
        try {
            $pg = Petitgroupe::findOrfail($id);
            $pg->update($request->all());
            return $this->sendResponse($pg, "Succès");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pg = Petitgroupe::findOrfail($id);
            Storage::disk('public')->delete($pg->photo_pg);
            if ($pg->photo_pepiniere != null) {
                $paths = explode(';', $pg->photo_pepiniere);
                Storage::disk('public')->delete($paths);
            }
            if ($pg->photo_arbre != null) {
                $paths = explode(';', $pg->photo_arbre);
                Storage::disk('public')->delete($paths);
            }
            $pg->delete();
            return $this->sendResponse(["user" => $pg], "Petit groupe supprimé avec succès");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
