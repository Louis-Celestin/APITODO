<?php

namespace App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SondageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $vote = Vote::all();

        return response()->json([
            'messsage'=>'Sondages',
            $vote
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Voter

            $this->validate($request, [

                'IdUser'=>'required',
                'IdOption'=>'required',
            ]);
            $vote = Vote::create([

                'IdUser'=>$request->IdUser,
                'IdOption'=>$request->IdOption
            ]);

            return response()->json($vote, 201);
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Mise a jour d'un vote
        $vote=Vote::find($id);
        $vote->update($request->all());
        return response([
            'message'=>'Mise a jour OK!',
            $vote
        ]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //Suppression du sondage
        $vote->delete();
        response()->json(
            [
                'message'=>'Suppression effectuée avec succes'
            ]
        );
    }
}
