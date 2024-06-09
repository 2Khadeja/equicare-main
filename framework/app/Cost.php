<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cost extends Model {
	use SoftDeletes;
	protected $table = 'costs';
	protected $guard_name = 'web';

	public function healthfacility() {
		return $this->belongsTo('App\healthfacility', 'healthfacility_id')->withTrashed();
	}
	public function scopehealthfacility($query)
	{
		return $query->whereIn('healthfacility_id', auth()->user()->healthfacilitys->pluck('id')->toArray());
			
	}
}
