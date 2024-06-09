<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class EquipmentRequest extends FormRequest {
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
	public function rules() {
		// dd($request->all());
		$dateFormat = env('date_convert', 'Y-m-d');
		return [
			'name' => 'required',
			'short_name' => 'required',
			'hospital_id' => 'required',
			'sr_no' => 'required|regex:/^\S*$/',
			'model' => 'required',
			'department' => 'required',
			'company' => 'required',
			'date_of_purchase' => 'required',
			// 'order_date'=>'before_or_equal:date_of_purchase',
			// 'date_of_installation'=>'after_or_equal:date_of_purchase',
			// 'warranty_due_date'=>'after_or_equal:date_of_purchase',
			'order_date' => "before_or_equal:date_of_purchase|date_format:$dateFormat",
			'date_of_installation' => "after_or_equal:date_of_purchase|date_format:$dateFormat",
			'warranty_due_date' => "after_or_equal:date_of_purchase|date_format:$dateFormat",
			'service_engineer_no' => 'required|numeric',
		];
	}
	public function messages() {
		return [
			'hospital_id.required' => 'The Hospital field is required.',
			'sr_no.required' => 'The Serial Number field is required.',
			'date_of_purchase.required' => 'The Purchase Date field is required.',
			'service_engineer_no.required' => 'The Service Engineer number field is required.',
			'sr_no.regex' => 'The Serial number field not allowed blank space.',
			'service_engineer_no.numeric' => 'The Service Engineer (Mobile no.) must be a Number.',
		];
	}
	protected function failedValidation(Validator $validator)
	{
		// Check if it's an API request based on the 'Accept' header
		if ($this->is('api/*')) {
			throw new HttpResponseException(responseData('0', 'Validation Errors', '', 401));
		}

		// For non-API requests, use the default behavior
		parent::failedValidation($validator);
	}

}
