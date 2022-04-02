<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DistrictController extends Controller
{
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return District::all(); //Api resource
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric','unique:districts'],
            'name' => ['required','string','max:60'],
            'province_id' => ['required', 'numeric','exists:provinces,id'],
        ]);

        return District::create($request->all()); //APi resource
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return District::findOrFail($id); //Api resource
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTownships($id)
    {
        return District::findOrFail($id)->townships; //Api resource
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
        $request->validate([
            'id' => ['required', 'numeric', Rule::unique('districts')->ignore($id)],
            'name' => ['required','string','max:60'],
            'province_id' => ['required', 'numeric', 'exists:provinces,id']
        ]);

        $district = District::findOrFail($id);
        $district->id = $request->id;
        $district->name = $request->name;
        $district->province_id = $request->province_id;
        $district->update();

        return $district; //Api resource
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return District::destroy($id); //APi resource
    }
}
