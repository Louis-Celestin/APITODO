<?php

namespace App\Http\Controllers\apiController\apiAdminController\Gestion_Projet;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Http\Request;
use App\Models\PropositionIdee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\IdeeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IdeeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $idees =  PropositionIdee::orderByDesc('created_at')->get();

        return response()->json($idees, 200);
        // return response()->json(["message"=>'Liste des propositions idéee trouvés avec succès.',$idee,200]);
        //return IdeeResource::collection($idee,$message);
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

        $validator = Validator::make($input,[
            'description' => 'required',
            'IdUser'=>'required',
            'IdTheme'=>'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(),
                'status' => false,
            ]);
        }

        $idee = New PropositionIdee();
        $idee->description = $request->input('description');
        $idee->IdUser = $request->input('IdUser');
        $idee->IdTheme = $request->input('IdTheme');
        $idee->save();
        return response()->json([
            "status"=>"True",
            "message"=>"Insertion réussie!",
            "proposIdees"=>$idee
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $idee = PropositionIdee::findOrFail($id);

        if(is_null($idee))
        {
            return response()->json(["status"=>"false","message"=>"Idée non trouvée!"],400);
        }
        return response()->json($idee,200);

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
        $input = $request->all();

        $validator = Validator::make($input,[
            'description' => 'required',
            'IdUser'=>'required',
            'IdTheme'=>'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(),
                'status' => false,
            ]);
        }

        $idee = PropositionIdee::findOrFail($id);

        $idee->description = $request->input('description');
        $idee->IdUser = $request->input('IdUser');
        $idee->IdTheme = $request->input('IdTheme');
        $idee->update();

        return response()->json([
            "status"=>"True",
            "message"=>"Modification réussie!",
            "proposIdees"=>$idee
        ],201);
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
        $idee = PropositionIdee::findOrfail($id);
        $idee->delete();
        return response()->json(['Supression effectué avec succès']);
    }


    public function ideeDelete()
    {
        $deleteIdee = DB::table('proposition_idees')
                ->where('deleted_at', '<>', null)
                ->get();

        return response()->json($deleteIdee);
    }
}
