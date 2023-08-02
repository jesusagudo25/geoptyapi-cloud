<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Province::all(); //Api resource
    }

    public function indexActive()
    {
        return Province::where('active', 1)->get(); //Api resource
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
            'id' => ['required', 'numeric','unique:provinces'],
            'name' => ['required','string','max:60']
        ]);

        return Province::create($request->all()); //APi resource
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Province::findOrFail($id); //Api resource
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDistricts($id)
    {
        return Province::findOrFail($id)->districts; //Api resource
    }

    public function showDistrictsActive($id)
    {
        return Province::findOrFail($id)->districts()->where('active', 1)->get(); //Api resource
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
            'id' => ['required', 'numeric', Rule::unique('provinces')->ignore($id)],
            'name' => ['required','string','max:60']
        ]);

        $province = Province::findOrFail($id);
        $province->id = $request->id;
        $province->name = $request->name;
        $province->active = $request->active;
        $province->update();

        return $province; //Api resource
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Province::destroy($id); //APi resource
    }
}
