<?php

namespace App\Http\Controllers\apiController\apiAdminController\apiGestionDecision;



use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TypeUtilisateur;
use App\Http\Controllers\Controller;
use App\Http\Resources\InformationResource;
use Illuminate\Support\Facades\Auth;
use App\Models\adminModels\Information;
use Illuminate\Support\Facades\Validator;
use App\Models\adminModels\TypeInformation;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $informations = Information::all();
           return InformationResource::collection($informations);

         // $infos= Information::All();
         // return response()->json($infos,201);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id, $user, $tinfo)
    {

        //Un Admin ou membre Membre Admin peut voir ces messages envoyer dans l'application mobile via son dashboard
        $Infos = Information::findOrFail($id);
        $usersnom = User::where("id",$user)->value('name');
        $usersprenom = User::where("id",$user)->value('prenom');
        $userTypeId = User::where("id",$user)->value('IdTypeUtilisateur');
        $userType =TypeUtilisateur::where("id", $userTypeId)->value('profil');

        $IdTypeInformation = TypeInformation::where("id", $tinfo)->value('titre');
        $data= [
            "id" =>$Infos->id,
            "titre" => $Infos->titre,
            "description "=>$Infos->description,
            "images"=> $Infos->images,
            "IdTypeInformation"=> $IdTypeInformation,
            "IdUser"=> $usersnom.$usersprenom,
            "userType"=> $userType
        ];

            return response()->json($data,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'titre' =>'required',
            'description' =>'required',
          //  'images' =>'required',
            'IdTypeInformation' =>'required',
            'IdUser' =>'required',


        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 'false',
                'message' => $validator->errors()
            ],400);
        }

        $userTypeId = User::where("id",$user)->value('IdTypeUtilisateur');
        $userType = TypeUtilisateur::where("id", $userTypeId)->value('profil');

        if($userType=="admin" || $userType=="membre_admin" ){

            $info = New Information();
            $info->titre = $request->input('titre');
            $info->description = $request->input('description');
            //insertion de l'images dans la base de la base de données
            if($request->hasfile('images')){
                $photo = $request->file('images');
                $extension = $photo->getClientOriginalName();
                $fileName = $extension;
                $photo->move('uploads/images/', $fileName);
                $info->images = $fileName;
            }
            $info->images = $request->input('images');
            $info->IdTypeInformation = $request->input('IdTypeInformation');
            $info->IdUser = $request->input('IdUser');

            $info->save();

         return response()->json(['status'=>'true','message' => 'insertion réussir',],201);

        }else{
            return response()->json(['status'=>'false','message'=>"Désolé vous n'êtes pas Administrateur ou un Membre Administrateur"],405);
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $infos)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'titre' =>'required',
            'description' =>'required',
          //  'images' =>'required',
            'IdTypeInformation' =>'required',
            'IdUser' =>'required',


        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 'false',
                'message' => $validator->errors()
            ],400);
        }

        $userTypeId = User::where("id",$user)->value('IdTypeUtilisateur');
        $userType = TypeUtilisateur::where("id", $userTypeId)->value('profil');

        if($userType=="admin" || $userType=="membre_admin" ){

            $info = Information::findOrFail($infos);
            $info->titre = $request->input('titre');
            $info->description = $request->input('description');
            //insertion de l'images dans la base de la base de données
            if($request->hasfile('images')){
                $photo = $request->file('images');
                $extension = $photo->getClientOriginalName();
                $fileName = $extension;
                $photo->move('uploads/images/', $fileName);
                $info->images = $fileName;
            }
            $info->images = $request->input('images');
            $info->IdTypeInformation = $request->input('IdTypeInformation');
            $info->IdUser = $request->input('IdUser');

            $info->save();

         return response()->json(['status'=>'true','message' => 'Modification réussir',],201);

        }else{
            return response()->json(['status'=>'false','message'=>"Désolé vous n'êtes pas Administrateur ou un Membre Administrateur"],405);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($infos)
    {
        $info = Information::findOrFail($infos);
        $info->delete();
        return response()->json(['status'=>'true','message' => 'Suppression réussir'],200);
    }
}
