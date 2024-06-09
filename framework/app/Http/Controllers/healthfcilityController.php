<?php

namespace App\Http\Controllers;

use App\healthfacility;
use App\Http\Requests\healthfacilityRequest;
use Auth;
use Illuminate\Http\Request;
use App\User;

class healthfacilityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->availibility('View healthfacilitys');
		$index['page'] = 'healthfacilitys';
		$index['healthfacilitys'] = healthfacility::all();

		return view('healthfacilitys.index', $index);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->availibility('Create healthfacilitys');
		$index['page'] = 'healthfacilitys';

		return view('healthfacilitys.create', $index);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(healthfacilityRequest $request)
	{
		$healthfacility = new healthfacility;
		$healthfacility->name = $request->name;
		$healthfacility->email = $request->email;
		$healthfacility->phone_no = $request->phone_no;
		$healthfacility->contact_person = $request->contact_person;
		$healthfacility->user_id = Auth::user()->id;
		$healthfacility->mobile_no = $request->mobile_no;
		$healthfacility->address = $request->address;
		$yourString = $healthfacility->name;
		$healthfacility->slug = $request->slug;

		if ($healthfacility->slug == "") {
			return redirect()->back()->with('flash_message_error', 'please choose another healthfacility, there are too many already')->withInput($request->all());
		}

		$healthfacility->save();
		User::where('select_all', 1)->get()->each(function ($user) use ($healthfacility) {
			$user->healthfacilitys()->attach($healthfacility->id);
		});
		return redirect('admin/healthfacilitys')->with('flash_message', 'healthfacility "' . $healthfacility->name . '" created');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\healthfacility  $healthfacility
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$this->availibility('Edit healthfacilitys');
		$index['page'] = 'healthfacilitys';
		$index['healthfacility'] = healthfacility::findOrFail($id);
		return view('healthfacilitys.edit', $index);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\healthfacility  $healthfacility
	 * @return \Illuminate\Http\Response
	 */
	public function update(healthfacilityRequest $request, $id)
	{
		$healthfacility = healthfacility::findOrFail($id);
		$healthfacility->name = $request->name;
		$healthfacility->email = $request->email;
		$healthfacility->contact_person = $request->contact_person;
		$healthfacility->phone_no = $request->phone_no;
		$healthfacility->mobile_no = $request->mobile_no;
		$healthfacility->address = $request->address;
		$healthfacility->slug = $request->slug;
		$healthfacility->save();

		return redirect('admin/healthfacilitys')->with('flash_message', 'healthfacility "' . $healthfacility->name . '" updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\healthfacility  $healthfacility
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$this->availibility('Delete healthfacilitys');
		$healthfacility = healthfacility::findOrFail($id);
		$healthfacility->delete();

		return redirect('admin/healthfacilitys')->with('flash_message', 'healthfacility "' . $healthfacility->name . '" deleted');
	}
	public static function availibility($method)
	{
		// $r_p = \Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
		if (\Auth::user()->hasDirectPermission($method)) {
			return true;
		} else {
			abort('401');
		}
		// if (\Auth::user()->hasDirectPermission($method)) {
		// 	return true;
		// } elseif (!in_array($method, $r_p)) {
		// 	abort('401');
		// } else {
		// 	return true;
		// }
	}
	public static function recursive($yourString)
	{
		if (strpos($yourString, " ") === false) {
			$vowels = array(
				"a",
				"e",
				"i",
				"o",
				"u",
				"A",
				"E",
				"I",
				"O",
				"U",
				" "
			);
			$yourString = str_replace($vowels, "", $yourString);
			$only_one_word = substr($yourString, 0, 1);
			$only_one_word .= substr($yourString, 1, 1);
			$check = healthfacility::where('slug', $only_one_word)->first();
			if ($check == "") {
				$result = $only_one_word;
			}
		} else {
			$words = explode(" ", $yourString);
			$first_char_after_space = substr($words[0], 0, 1);
			$first_char_after_space .= substr($words[1], 0, 1);
			if (array_key_exists(2, $words)) {
				$first_char_after_space .= substr($words[2], 0, 1);
			}
			$check_first_two_char_of_words = healthfacility::where('slug', $first_char_after_space)->first();
			if ($check_first_two_char_of_words == "") {
				$result = $first_char_after_space;
			} else {
				$result = "";
			}
			if ($result == "") {
				$vowels = array(
					"a",
					"e",
					"i",
					"o",
					"u",
					"A",
					"E",
					"I",
					"O",
					"U",
					" "
				);
				$yourString = str_replace($vowels, "", $yourString);
				$count = 1;
				for ($i = 1; $i <= strlen($yourString); $i++) {
					$first_char = substr($yourString, 0, 1);
					$first_char .= substr($yourString, $i, 1);
					$check_first_two_char = healthfacility::where('slug', $first_char)->first();
					if ($count < strlen($yourString)) {
						if ($check_first_two_char == "") {
							$result = $first_char;
							break;
						}
					}
					$count++;
				}
			}
		}
		return $result;
	}
}
