<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $display_name
 *
 * @package App\Models
 */
class Role extends Model
{
    use HasFactory;

	protected $table = 'roles';

	protected $fillable = [
		'name',
		'guard_name',
		'display_name'
	];


}
