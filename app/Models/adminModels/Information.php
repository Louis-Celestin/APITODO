<?php

namespace App\Models\adminModels;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\InformationFactory;
use App\Models\adminModels\TypeInformation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Information extends Model
{
    use HasFactory,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "informations";
    protected $fillable = [
        'id',
        'titre',
        'description',
        'images',
        'IdTypeInformation',
        'IdUser',
    ];

    /**
 * Create a new factory instance for the model.
 *
 * @return \Illuminate\Database\Eloquent\Factories\Factory
 */
protected static function newFactory()
{
    return new InformationFactory();
}

public function type_information()
{
    return $this->belongsTo(TypeInformation::class,'IdTypeInformation','id');
}

public function user()
{
    return $this->belongsTo(User::class,'IdUser','id');
}


}
