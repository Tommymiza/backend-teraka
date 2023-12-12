<?php

namespace App\Http\Controllers;

use App\Models\Petitgroupe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\type;

class PetitGroupeController extends Controller
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
            $data = $request->all();
            $photo_pg = $request->file('photo_pg');
            $pathPhoto = $photo_pg->store('pg', 'public');
            $photo_pepiniere = null;
            if ($request->hasFile('files')) {
                $photo_pepiniere = '';
                foreach ($request->file('files') as $file) {
                    $path = $file->store('pepiniere', 'public');
                    $photo_pepiniere = $photo_pepiniere . ';' . $path;
                }
            }
            $data['photo_pepiniere'] = $photo_pepiniere;
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
    public function show(PetitGroupe $petitGroupe)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PetitGroupe $petitGroupe)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetitGroupe $petitGroupe)
    {
        //
    }
}
