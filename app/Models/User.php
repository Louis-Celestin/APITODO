<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'prenom',
        'phone',
        'sexe',
        'date_naissance',
        'lieu_naissance',
        'IdCommune',
        'IdTypeUtilisateur'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'IdCommune' => 'int',
		'IdTypeUtilisateur' => 'int'
    ];

    public function findForPassport($identifier){
        return $this->orWhere('email',$identifier)->orWhere('phone',$identifier)->first();
    }

    public function accessTokens(){
        return $this->hasMany('App\OauthAcessToken');
    }


    public function type_utilisateur()
	{
		return $this->belongsTo(TypeUtilisateur::class, 'IdTypeUtilisateur');
	}

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'IdCommune');
	}

	public function demande_extraits()
	{
		return $this->hasMany(DemandeExtrait::class, 'IdUser');
	}

	public function information()
	{
		return $this->hasMany(Information::class, 'IdUser');
	}

	public function options()
	{
		return $this->hasMany(Option::class, 'IdUser');
	}

	public function participers()
	{
		return $this->hasMany(Participer::class, 'IdUser');
	}

	public function preferences()
	{
		return $this->hasMany(Preference::class, 'IdUser');
	}

	public function problemes()
	{
		return $this->hasMany(Probleme::class, 'IdUser');
	}

	public function proposition_idees()
	{
		return $this->hasMany(PropositionIdee::class, 'IdUser');
	}

	public function reagirs()
	{
		return $this->hasMany(Reagir::class, 'IdUser');
	}

	public function role_permissions()
	{
		return $this->hasMany(RolePermission::class, 'IdUser');
	}

	public function sondages()
	{
		return $this->hasMany(Sondage::class, 'IdUser');
	}

	public function votes()
	{
		return $this->hasMany(Vote::class, 'IdUser');
	}
}
