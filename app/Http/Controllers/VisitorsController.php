<?php

namespace App\Http\Controllers;

use App\Models\Barangays;
use App\Models\Municipalities;
use App\Models\Provinces;
use App\Models\Visitors;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $visitors = Visitors::get();
        $provinces = Provinces::all();
        $municipalities = Municipalities::with('province')->get();
        $barangays = Barangays::with('municipality.province')->get();

        return view('index', [
            'visitors' => $visitors,
            'provinces' => $provinces,
            'municipalities' => $municipalities,
            'barangays' => $barangays,
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
        // Validate the incoming data
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_phone_no' => 'required|string|regex:/^\+?\d{10,13}$/',  // Validates phone number, allows optional + and requires 10-13 digits
            'visitor_purpose' => 'required|string|max:500',
            'visit_date' => 'required|date',
            'province_id' => 'required|exists:provinces,id',  // Validates that the selected province exists
            'municipality_id' => 'required|exists:municipalities,id',  // Validates that the selected municipality exists
            'barangay_id' => 'required|exists:barangays,id',  // Validates that the selected barangay exists
        ]);


        try {
            // Save the validated data to the database
            Visitors::create($validated);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Visitor added successfully!');
        } catch (\Exception $e) {
            // Redirect back with an error message if saving fails
            return redirect()->back()->with('error', 'An error occurred while saving the visitor. Please try again.');
        }
    }


    public function getMunicipalities(Request $request)
    {
        $municipalities = Municipalities::where('province_id', $request->province_id)->get();

        if ($municipalities->isEmpty()) {
            return response()->json(['error' => 'No municipalities found for this province.'], 404);
        }

        return response()->json($municipalities);
    }

    public function getBarangays(Request $request)
    {
        $barangays = Barangays::where('municipality_id', $request->municipality_id)->get();

        return response()->json($barangays);
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitors  $visitors
     * 
     */
    public function show(Visitors $visitors)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitors  $visitors
     * 
     */
    public function edit(Visitors $visitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitors  $visitors
     * 
     */
    public function update(Request $request, Visitors $visitors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitors  $visitors
     * 
     */
    public function destroy(Visitors $visitors)
    {
        //
    }
}
