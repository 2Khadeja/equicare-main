<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calibration extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'calibrations';
	protected $guard_name = 'web';

	public function equipment() {
		return $this->belongsTo('App\Equipment', 'equip_id')->withTrashed();
	}
	public function user() {
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
	}
	public function scopehealthfacility($query)
	{
		return
			$query->join('equipments', 'calibrations.equip_id', '=', 'equipments.id')->whereIn('equipments.healthfacility_id', auth()->user()->healthfacilitys->pluck('id')->toArray())->select('calibrations.*');
	}

}
