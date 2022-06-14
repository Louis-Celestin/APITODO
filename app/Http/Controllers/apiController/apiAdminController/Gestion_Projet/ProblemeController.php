<?php

namespace App\Http\Controllers\apiController\apiAdminController\Gestion_Projet;

use App\Models\Probleme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProblemeResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProblemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Probleme::latest()->get();

        return response()->json(["status"=>"true", "message"=>"Liste des projets trouvés avec succès!.",'problemes'=>$data],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'image' => 'required',
            'commentaire' =>'required',
            'localisation' =>'required',
            'IdUser' =>'required',

        ]);

        //conditions de stokage
        if($validator->fails()){
            return response()->json('Validation Erreur.', $validator->errors());
        }

         Probleme::create([
            'image'=>$request->image,
            'commentaire'=>$request->commentaire,
            'localisation'=>$request->localisation,
            'IdUser'=>$request->IdUser,
        ]);
        return response()->json(["status"=>"true","message" =>"Projet crée avec succès."],201);




     }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $probleme = Probleme::findOrFail($id);
        if(is_null($probleme)) {
            return response()->json(["message"=>'Projet non trouvé!', "status"=>404]);
        }
        return response()->json($probleme,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
