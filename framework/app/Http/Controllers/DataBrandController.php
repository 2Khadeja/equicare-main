<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBrand;
use Auth;
use App\User;

class DataBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		//$this->availibility('View brands');
		$index['page'] = 'brands';
		$index['brands'] = DataBrand::all();

		// return view('hospitals.index', $index);
        return view('data_brands.index',$index);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'brands';
        return view('data_brands.create',$index);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        DataBrand::create($data);
        
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = DataBrand::findOrFail($id);
        
        return view('data_brands.show', compact('brand'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = DataBrand::findOrFail($id);
        
        return view('data_brands.edit', compact('brand'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $brand = DataBrand::findOrFail($id);
        $brand->update($data);
        
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = DataBrand::findOrFail($id);
        $brand->delete();
        
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
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
}
