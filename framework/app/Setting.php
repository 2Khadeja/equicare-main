<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model {
	use SoftDeletes;
	protected $table = 'settings';
	protected $fillable = ['logo', 'company'];
	protected $guard_name = 'web';
}
