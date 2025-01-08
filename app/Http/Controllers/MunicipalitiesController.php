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

        // Check for duplicate municipality
        $existingMunicipality = Municipalities::where('municipality_name', $request->municipality_name)
            ->where('province_id', $request->province_id)
            ->first();

        if ($existingMunicipality) {
            // Pass the old input and show a duplicate error message
            return redirect()->back()->withInput()->withErrors(['municipality_name' => 'This municipality already exists in the selected province.']);
        }

        // Create the municipality
        Municipalities::create([
            'municipality_name' => $request->municipality_name,
            'province_id' => $request->province_id,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Municipality saved successfully.');
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
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        // $request->validate([
        //     'municipality_name' => 'required|string|max:255',
        //     'province_id' => 'required|exists:provinces,id',
        // ]);

        // // Find the municipality and update it
        $municipality = Municipalities::findOrFail($id);
        $municipality->update([
            'municipality_name' => $request->municipality_name
        ]);

        // Redirect or send a response
        return redirect()->back()->with('success', 'Municipality updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy($id)
    {
        $municipality = Municipalities::findOrFail($id);
        $municipality->delete();

        return response()->json(['success' => true]);
    }

}
