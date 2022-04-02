<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TownshipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Township::all(); //Api resource
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
            'id' => ['required', 'numeric','unique:townships'],
            'name' => ['required','string','max:60'],
            'district_id' => ['required', 'numeric','exists:districts,id'],
        ]);

        return Township::create($request->all()); //APi resource
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Township::findOrFail($id); //Api resource
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
            'id' => ['required', 'numeric', Rule::unique('townships')->ignore($id)],
            'name' => ['required','string','max:60'],
            'district_id' => ['required', 'numeric', 'exists:districts,id']
        ]);

        $township = Township::findOrFail($id);
        $township->id = $request->id;
        $township->name = $request->name;
        $township->district_id = $request->district_id;
        $township->update();

        return $township; //Api resource
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Township::destroy($id); //APi resource
    }
}
