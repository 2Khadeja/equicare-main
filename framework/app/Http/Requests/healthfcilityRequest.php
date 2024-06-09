<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\healthfcility;

class healthfcilityRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(Request $request) {
		
		
			$rules=[
			'name' => 'required|unique:healthfcilitys,name,'.$request->id,
			'email' => 'required',
			'contact_person' => 'required',
			'phone_no' => 'required|numeric|min:6',
			'mobile_no' => 'required|numeric|min:10',
			'address' => 'required',
	     	'slug'=>'required|max:8|unique:healthfcilitys,slug,'.$request->id,
			];
			return $rules;
		}
	public function messages() {
		return [
			'mobile_no.required' => 'The Mobile number field is required.',
			'phone_no.required' => 'The Phone number field is required.',
			'slug.required'=>'The Short Name Is Required',
			'slug.max'=>'The Short Name Contain Maximum 8 Character',
			'slug.unique'=>'The Short Name Should be Unique',
		];
	}
}
