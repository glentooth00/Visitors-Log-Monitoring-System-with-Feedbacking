<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $offices = Office::simplePaginate(10); // Fetch 10 offices per page
        return view('admin.offices.index', ['offices' => $offices]);
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
        $validateData = $request->validate([
            'office_name' => 'string|max:255',
        ]);

        Office::create($validateData);

        return redirect()->back()->with('success', 'Office successfully added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * 
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * 
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * 
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * 
     */
    public function destroy(Office $office)
    {
        //
    }
}