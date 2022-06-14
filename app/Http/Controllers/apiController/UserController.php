<?php
namespace App\Http\Controllers\apiController;

use Carbon\carbon;
use App\Models\User;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Models\TypeUtilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' =>'required',
            'email' =>'required||unique:users,email',
            'prenom' =>'required',
            'phone' =>'required||unique:users,phone',
            'sexe' =>'required',
            'date_naissance' =>'required',
            'lieu_naissance' =>'required',
            'IdCommune' =>'required',
            'IdTypeUtilisateur' =>'required',
            'password' =>'required',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 'false',
                'message' => $validator->errors()
            ],200);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->prenom = $request->input('prenom');
        $user->phone = $request->input('phone');
        $user->sexe = $request->input('sexe');
        $user->date_naissance = $request->input('date_naissance');
        $user->lieu_naissance= $request->input('lieu_naissance');
        $user->IdCommune = $request->input('IdCommune');
        $user->IdTypeUtilisateur = $request->input('IdTypeUtilisateur');
        $user->password = Hash::make($request->input('password'));
        $user->created_at = carbon::now();
        $user->updated_at = carbon::now();
        $user->email_verified_at = carbon::now();
        $user->save();


        if (Auth::attempt(['phone' => $request->input('phone'), 'password' => $request->input('password')])) {
        $user= Auth::user();
        $IdCommune = Commune::where("id", $user->IdCommune)->value('nom');
        $IdTypeUtilisateur = TypeUtilisateur::where("id", $user->IdTypeUtilisateur)->value('profil');
        $data= [
            "id" => $user->id,
            "name" => $user->name,
            "email "=>$user->email,
            "prenom"=> $user->prenom,
            "phone"=> $user->phone,
            "sexe"=> $user->sexe,
            "date_naissance"=> $user->date_naissance,
            "lieu_naissance"=> $user->lieu_naissance,
            "IdCommune"=>$IdCommune,
            "IdTypeUtilisateur"=>$IdTypeUtilisateur,

        ];


        return response()->json([
            'status' => 'true',
            'message' => 'Inscription réussir',

            'data'=>$data

        ],201);

        // return UserResource::collection(User::get());

    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $loginData = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Vos Informations sont Incorrectes!.','status'=>'False'],400);
        }

      if (Auth::attempt(['phone' => $request->input('phone'), 'password' => $request->input('password')])) {
        $user= Auth::user();
        $IdCommune = Commune::where("id", $user->IdCommune)->value('nom');
        $IdTypeUtilisateur = TypeUtilisateur::where("id", $user->IdTypeUtilisateur)->value('profil');
       $accessToken = $user->createToken('authToken')->accessToken;

        $data= [
            "id" => $user->id,
            "name" => $user->name,
            "email"=>$user->email,
            "prenom"=> $user->prenom,
            "phone"=> $user->phone,
            "sexe"=> $user->sexe,
            "date_naissance"=> $user->date_naissance,
            "lieu_naissance"=> $user->lieu_naissance,
            "IdCommune"=>$IdCommune,
            "IdTypeUtilisateur"=>$IdTypeUtilisateur,
            "token"=>$accessToken

        ];


        return response()->json([
            'status' => 'true',
            'message' => 'Connexion réussir',
            'data'=>$data
        ],201);
     }
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
        $validator = Validator::make($input, [
            'name' =>'required',
            'prenom' =>'required'

        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 'false',
                'message' => $validator->errors()
            ],200);
        }

        $user = User::findOrFail($id);;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->prenom = $request->input('prenom');
        $user->phone = $request->input('phone');
        $user->sexe = $request->input('sexe');
        $user->date_naissance = $request->input('date_naissance');
        $user->lieu_naissance= $request->input('lieu_naissance');
        $user->IdCommune = $request->input('IdCommune');
      //  $user->password = Hash::make($request->input('password'));
        $user->created_at = carbon::now();
        $user->updated_at = carbon::now();
        $user->email_verified_at = carbon::now();
        $user->update();
        return response()->json(['status'=>'true','message' => 'Modification soumis avec Succès!.'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status'=>'true','message' => 'Suppression réussir'],200);

    }
}
