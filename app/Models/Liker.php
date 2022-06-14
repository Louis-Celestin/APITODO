<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Liker;
use App\Models\PropositionIdee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PropositionIdee
 *
 * @property int $id
 * @property int $IdUser
 * @property int $IdPropositionIdee
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 *
 * @property PropositionIdee $propositionIdee
 * @property User $user
 *
 * @package App\Models
 */
class Liker extends Model
{
	use SoftDeletes;
	protected $table = 'likers';

	protected $casts = [
        'id' => 'int',
		'IdUser' => 'int',
		'IdPropositionIdee' => 'int'
	];

	protected $fillable = [
        'id',
		'IdUser',
		'IdPropositionIdee',
	];
	public function user()
	{
		return $this->belongsTo(User::class, 'IdUser');
	}
	public function propositionIdee()
	{
		return $this->belongsTo(PropositionIdee::class, 'IdPropositionIdee');
	}
}
