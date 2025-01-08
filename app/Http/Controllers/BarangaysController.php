<?php

namespace App\Http\Controllers;

use App\Models\Barangays;
use App\Models\Municipalities;
use App\Models\Provinces;
use Illuminate\Http\Request;

class BarangaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $provinces = Provinces::all();
        $municipalities = Municipalities::with('province')->get();
        $barangays = Barangays::with('municipality.province')->simplePaginate(10);

        return view('admin.barangays.index', [
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'barangay_name' => 'required|string|max:255',
            'municipality_id' => 'required|exists:municipalities,id',
            'province_id' => 'required|exists:provinces,id',
        ]);

        // Create a new Barangay
        $barangay = new Barangays();
        $barangay->barangay_name = $validatedData['barangay_name'];
        $barangay->municipality_id = $validatedData['municipality_id'];
        $barangay->province_id = $validatedData['province_id'];
        $barangay->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Barangay added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barangays  $barangays
     *
     */
    public function show(Barangays $barangays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barangays  $barangays
     *
     */
    public function edit(Barangays $barangays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *

     *
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'barangay_name' => 'required|string|max:255'
        ]);

        // Find the barangay by ID
        $barangay = Barangays::findOrFail($id);

        // Update barangay details
        $barangay->update([
            'barangay_name' => $validatedData['barangay_name'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Barangay updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy($id)
    {
        // Find the barangay by ID
        $barangay = Barangays::findOrFail($id);

        // Delete the barangay
        $barangay->delete();

        // Return a JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Barangay deleted successfully.',
        ]);
    }


}
