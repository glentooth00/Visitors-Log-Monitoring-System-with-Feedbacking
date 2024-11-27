<?php

namespace App\Http\Controllers;

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
        $visitors =  Visitors::get();

        return view('index',[
            'visitors' => $visitors
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
            'visitor_phone_no' => 'required|string',
            'visitor_purpose' => 'required|string|max:500',
            'visit_date' => 'required|date',
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
