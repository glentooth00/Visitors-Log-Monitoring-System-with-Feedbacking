<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Visitors;
use App\Models\OfficeFeedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        //
    }

public function submitFeedback(Request $request)
{
    $validated = $request->validate([
        'visitor_id' => 'required|exists:visitors,id',
        'visit_date' => 'required|date',
        'visit_time' => 'required|date_format:H:i:s',
        'rating' => 'required|array',
        'rating.*' => 'in:1,2,3,4,5',
    ]);

    // Dump the validated data before saving
    dd($validated);

    // foreach ($validated['rating'] as $office => $rating) {
    //     OfficeFeedback::create([
    //         'visitor_id' => $validated['visitor_id'],
    //         'office_name' => $office,
    //         'rating' => $rating,
    //     ]);
    // }

    // return redirect()->back()->with('success', 'Feedback submitted successfully!');
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
            'visitor_id' => 'required|exists:visitors,id',
            'attentiveness' => 'nullable|integer|min:1|max:5',
            'courtesy' => 'nullable|integer|min:1|max:5',
            'friendliness' => 'nullable|integer|min:1|max:5',
            'helpfulness' => 'nullable|integer|min:1|max:5',
            'knowledge' => 'nullable|integer|min:1|max:5',
            'promptness' => 'nullable|integer|min:1|max:5',
            'quality_of_service' => 'nullable|integer|min:1|max:5',
            'speed_of_service' => 'nullable|integer|min:1|max:5',
            'quality_of_facilities' => 'nullable|integer|min:1|max:5',
            'availability_of_facilities' => 'nullable|integer|min:1|max:5',
            'cleanliness' => 'nullable|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
            'status' => 'integer|min:1',
        ]);

        $validated['status'] = 1;

        // Save the feedback to the database
        $feedback = Feedback::create($validated);

        // Find the visitor and update their feedback status
        $visitor = Visitors::find($validated['visitor_id']);
        if ($visitor) {
            $visitor->feedback_status = 1;  // Update the feedback status
            $visitor->save();  // Save the updated visitor model
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        //
    }
}
