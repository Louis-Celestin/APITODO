<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Sondage
 *
 * @property int $id
 * @property string $description
 * @property int $IdUser
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Sondage extends Model
{
    use SoftDeletes;
	protected $table = 'sondages';



	protected $fillable = [
        'id',
		'description',
		'IdUser'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'IdUser');
	}


}
