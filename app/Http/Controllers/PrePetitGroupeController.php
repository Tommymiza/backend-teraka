<?php

namespace App\Http\Controllers;

use App\Models\Prepetitgroupe;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

use function Laravel\Prompts\error;

class PrePetitGroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(["prepetitgroupes" => Prepetitgroupe::all()], "Succés");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Prepetitgroupe::create($request->all());
            return $this->sendResponse([], "Demande pris en compte");
        } catch(Error $error) {
            Log::debug($error);
            return $this->sendError($error, 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrePetitGroupe $prePetitGroupe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrePetitGroupe $prePetitGroupe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrePetitGroupe $prePetitGroupe)
    {
        //
    }
}
