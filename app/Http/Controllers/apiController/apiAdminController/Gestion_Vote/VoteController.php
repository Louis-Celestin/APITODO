<?php

namespace App\Http\Controllers\apiController\apiAdminController\Gestion_Vote;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vote = Vote::orderByDesc('created_at')->get();
        return Response()->json($vote,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user, $option,$id)
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

        $vote= New Vote();
        $vote->IdUser = $request->input('IdUser');
        $vote->IdOption = $request->input('IdOption');
        $vote->save();
        return response()->json([
            "status"=>"True",
            "message"=>"Insertion réussie!",
            "vote"=>$vote
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $option,$id)
    {
        $vote = Vote::findOrFail($id);

        if(is_null($vote))
        {
            return response()->json(["status"=>"false","message"=>"Idée non trouvée!"],400);
        }
        return response()->json($vote,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $option,$id)
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
