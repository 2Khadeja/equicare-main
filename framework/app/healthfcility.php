<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class healthfcility extends Model {
	use SoftDeletes;

	protected $table = 'healthfacilitys';
	protected $guard_name = 'web';
	protected $fillable = ['name', 'slug', 'address', 'contact_person', 'phone_no', 'mobile_no', 'email', 'user_id'];

	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}
	public function setSlugAttribute($value) {
		$this->attributes['slug'] = strtoupper($value);
	}
	public function users()
	{
		return $this->belongsToMany(User::class);
	}
	public function scopehealthfacility($query)
	{
		return $query->whereIn('id', auth()->user()->healthfacilitys->pluck('id')->toArray());
	}
}
