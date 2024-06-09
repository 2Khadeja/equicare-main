<?php

namespace App;
use App\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Equipment extends Model {
	use SoftDeletes;
	protected $table = 'equipments';
	protected $guard_name = 'web';
	protected $fillable = [
		'name', 'short_name', 'user_id', 'healthfacility_id', 'company', 'model',
		'sr_no', 'unique_id', 'department', 'order_date', 'date_of_purchase'
		, 'date_of_installation', 'warranty_due_date', 'service_engineer_no'
		, 'is_critical', 'notes','qr_id'
	];

	public function healthfacility() {
		return $this->belongsTo('App\healthfacility', 'healthfacility_id')->withTrashed();
	}
	public function get_department() {
		return $this->belongsTo('App\Department', 'department')->withTrashed();
	}

	public function getUniqueIdAttribute($value) {
	$uid = explode('/', $value);
		$department = Department::find($uid[0]);
		if (is_null($department)) {
			return $value;
		}
		$uid[0] = $department->short_name;
		$uid = implode('/', $uid);
		return $uid;
	}
	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}
	public function call_entry() {
		return $this->hasOne('App\CallEntry', 'equip_id', 'id');
	}
	public function pm() {
		return $this->hasOne('App\CallEntry', 'equip_id', 'id')->where('call_type', 'preventive')->latest();
	}
	public function calibration() {
		return $this->hasOne('App\Calibration', 'equip_id', 'id');
	}
	public function scopehealthfacility($query)
	{
		return
			$query->whereIn('healthfacility_id', auth()->user()->healthfacilitys->pluck('id')->toArray());
	}
	
}
