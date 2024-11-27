<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $provinces =  Provinces::all();

        return view('admin.provinces.province',[
            'provinces' => $provinces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'province_name' => 'required|string|max:255',
        ]);
    
        Provinces::create([
            'province_name' => $request->province_name,
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Province saved successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provinces  $provinces
     * 
     */
    public function show(Provinces $provinces)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provinces  $provinces
     * 
     */
    public function edit(Provinces $provinces)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provinces  $provinces
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinces $provinces)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provinces  $provinces
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinces $provinces)
    {
        //
    }
}
