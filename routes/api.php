<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController\UserController;
use App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\InformationController;
use App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\TypeInformationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//gestion de compte
Route::post('/login', [App\Http\Controllers\apiController\UserController::class,'login']);
Route::post('/register', [App\Http\Controllers\apiController\UserController::class,'register']);
Route::put('/update/{id}', [App\Http\Controllers\apiController\UserController::class,'update']);
Route::delete('/delete/{id}', [App\Http\Controllers\apiController\UserController::class,'destroy']);

// Api Decision (Information)
Route::get('/informationShow/{id}/{user}/{tinfo}', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\InformationController::class,'show']);
Route::get('/informationIndex', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\InformationController::class,'index']);
Route::post('/informationStore/{user}', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\InformationController::class,'store']);
Route::put('/informationUpdate/{user}/{infos}', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\InformationController::class,'update']);
Route::delete('/informationdelete/{infos}', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\InformationController::class,'destroy']);


// Api Decision (TypeInformation)
Route::get('/typeInformationIndex', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\TypeInformationController::class,'index']);
Route::post('/typeInformationStore', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\TypeInformationController::class,'store']);
Route::put('/typeInformationUpdate/{id}', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\TypeInformationController::class,'update']);


// Api Decision (Preference)
Route::get('/preferenceIndex', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\PreferenceController::class,'index']);
Route::post('/preferenceStore', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\PreferenceController::class,'store']);
Route::post('/preferenceUpdate/{id}', [App\Http\Controllers\apiController\apiAdminController\apiGestionDecision\PreferenceController::class,'update']);

//API Collecte
Route::get('/collecteIndex', [App\Http\Controllers\apiController\apiAdminController\Gestion_Collecte\CollecteController::class,'index']);
Route::post('/collecteStore', [App\Http\Controllers\apiController\apiAdminController\Gestion_Collecte\CollecteController::class,'Store']);

//DyDja
Route::get('/list-projectIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProjetAdminController::class,'index']);
Route::get('/list-projectShow/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProjetAdminController::class,'show']);
Route::post('/create-projectStore',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProjetAdminController::class,'store']);
Route::put('/projectUpdate/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProjetAdminController::class,'update']);
Route::delete('/delete-projectDelete/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProjetAdminController::class,'destroy']);


/**
* ROUTE IDEE FOR USER AND ADMIN
*/

Route::get('/list-ideeIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\IdeeAdminController::class,'index']);
Route::post('/create-ideeStore',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\IdeeAdminController::class,'store']);
Route::get('/list-ideeShow/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\IdeeAdminController::class,'show']);
Route::put('/ideeUpdate/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\IdeeAdminController::class,'update']);
Route::delete('/ideeDestroy/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\IdeeAdminController::class,'destroy']);
//Api pour le listing des propositions d'idéee supprimé
Route::get('/delete-idee',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\IdeeAdminController::class,'ideeDelete']);


//ROUTE POUR LE PROBLEME
Route::post('/create-problemeStore',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProblemeController::class,'store']);
Route::get('/list-problemeIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProblemeController::class,'index']);
Route::get('/list-problemeShow/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Projet\ProblemeController::class,'Show']);
//Fin DyDja


//Celestin
//API Sondage
Route::get('/sondageIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\SondageController::class,'index']);
Route::post('/sondageStore',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\SondageController::class,'store']);
Route::get('/sondageShow/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\SondageController::class,'show']);
Route::put('/sondageUpdate/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\SondageController::class,'Update']);
Route::delete('/sondageDelete/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\SondageController::class,'destroy']);


//API Options
Route::get('/optionIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'index']);
Route::post('/optionStore',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'store']);
Route::get('/optionShow/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'show']);
Route::put('/optionUpdate/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'Update']);
Route::delete('/optionDelete/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'destroy']);
//Fin CelesTin


//Services Administratifs

//Extrait de Naissance

Route::get('/ExtNaissIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'index']);
Route::post('/ExtNaissStore',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'store']);
Route::get('/ExtNaissShow/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'show']);
Route::put('/ExtNaissUpdate/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'Update']);
Route::delete('/ExtNaissDelete/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Sondage\OptionController::class,'destroy']);


//Table MLD


//Vote
Route::get('/voteIndex',[App\Http\Controllers\apiController\apiAdminController\Gestion_Vote\VoteController::class,'index']);
Route::post('/voteStore/{user}/{option}/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Vote\VoteController::class,'store']);
Route::get('/voteShow/{user}/{option}/{id}',[App\Http\Controllers\apiController\apiAdminController\Gestion_Vote\VoteController::class,'show']);

//rolePermission



//Comptage des informations pour le dashboard
Route::get('/nbProblemes',[App\Http\Controllers\apiController\CountApiController::class,'problemes']);
Route::get('/nbSondages',[App\Http\Controllers\apiController\CountApiController::class,'sondages']);
Route::get('/nbCollectes',[App\Http\Controllers\apiController\CountApiController::class,'collectes']);
Route::post('/liker/{IdUser}',[App\Http\Controllers\apiController\CountApiController::class,'Liker']);

