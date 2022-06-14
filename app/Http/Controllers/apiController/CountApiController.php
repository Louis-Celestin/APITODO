<?php

namespace App\Http\Controllers\apiController;

use App\Models\User;
use App\Models\Liker;
use App\Models\Sondage;
use App\Models\Collecte;
use App\Models\Probleme;
use Illuminate\Http\Request;
use App\Models\PropositionIdee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CountApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //Nombre total de problemes

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function problemes()
    {
        $problemes = Probleme::count();
        if ($problemes==0){
            return response()->json("Aucun probleme");
        }
        return response()->json($problemes,200);
    }

    //Nombre total de sondages

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sondages(){

        $sondages = Sondage::count();
        if ($sondages==0){
            return response()->json("Aucun sondage");
        }
        return response()->json($sondages,200);
    }
    //Nombre total de collectes

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function collectes(){

        $collectes = Collecte::count();
        if ($collectes==0){
            return response()->json("Aucune collecte");
        }
        return response()->json($collectes,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function liker(Request $request,$IdUSer)
    {
        $res = DB::select('SELECT IdUserLiker FROM proposition_idees');
        $res = json_decode($res, true);


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
