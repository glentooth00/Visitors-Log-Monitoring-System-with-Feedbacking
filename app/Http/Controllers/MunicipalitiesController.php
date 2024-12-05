<?php

namespace App\Http\Controllers;

use App\Models\Municipalities;
use App\Models\Provinces;
use Illuminate\Http\Request;

class MunicipalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        // Paginate municipalities with 10 entries per page
        $municipalities = Municipalities::with('province')->simplePaginate(10);

        // Retrieve all provinces
        $provinces = Provinces::all();

        // Return the view with paginated municipalities and provinces
        return view('admin.municipalities.index', [
            'municipalities' => $municipalities,
            'provinces' => $provinces,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
            'municipality_name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        Municipalities::create([
            'municipality_name' => $request->municipality_name,
            'province_id' => $request->province_id,
        ]);

        return redirect()->back()->with('success', 'Municipality added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipalities  $municipalities
     * @return \Illuminate\Http\Response
     */
    public function show(Municipalities $municipalities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipalities  $municipalities
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipalities $municipalities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipalities  $municipalities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipalities $municipalities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipalities  $municipalities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipalities $municipalities)
    {
        //
    }
}
