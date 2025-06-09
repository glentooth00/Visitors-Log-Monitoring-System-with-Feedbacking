<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Visitors;
use App\Models\OfficeFeedback;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Provinces;
use App\Models\Municipalities;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $visitors  = Feedback::all();
                // $visitors = Visitors::get();
                $offices = Office::all();
                 $provinces = Provinces::all();
                 $municipalities = Municipalities::with('province')->get();

        return view('admin.feedbacks.index',[
            // 'getAllFeedbacks' => $getAllFeedBacks,
            'visitors' => $visitors,
            'offices' => $offices,
            'provinces' => $provinces,
            'municipalities' => $municipalities,
        ]);
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
    $feedback = Feedback::findOrFail($id);

    $categories = [
        'Staff Personnel' => [
            'attentiveness' => 'Attentiveness',
            'courtesy' => 'Courtesy',
            'friendliness' => 'Friendliness',
            'helpfulness' => 'Helpfulness',
            'knowledge' => 'Knowledge',
            'promptness' => 'Promptness',
        ],
        'Service' => [
            'quality_of_service' => 'Quality of Service',
            'speed_of_service' => 'Speed of Service',
        ],
        'Facilities/Amenities' => [
            'quality_of_facilities' => 'Quality of Facilities',
            'availability_of_facilities' => 'Availability of Facilities',
            'cleanliness' => 'Cleanliness',
        ],
    ];

    $ratings = collect($categories)->flatMap(function ($fields) {
        return $fields;
    })->keys()->map(function ($field) use ($feedback) {
        return is_numeric($feedback->$field) ? (int)$feedback->$field : null;
    })->filter();

    $averageRating = $ratings->isNotEmpty() ? round($ratings->avg(), 2) : null;

    $ratingText = 'Not Available';
    $ratingColor = 'secondary';

    if (!is_null($averageRating)) {
        if ($averageRating >= 1 && $averageRating < 2) {
            $ratingText = 'Very Dissatisfied';
            $ratingColor = 'danger';
        } elseif ($averageRating >= 2 && $averageRating < 3) {
            $ratingText = 'Dissatisfied';
            $ratingColor = 'warning';
        } elseif ($averageRating >= 3 && $averageRating < 4) {
            $ratingText = 'Neutral';
            $ratingColor = 'secondary';
        } elseif ($averageRating >= 4 && $averageRating < 5) {
            $ratingText = 'Satisfied';
            $ratingColor = 'primary';
        } elseif ($averageRating == 5) {
            $ratingText = 'Very Satisfied';
            $ratingColor = 'success';
        }
    }

    return view('admin.offices.show', compact('feedback', 'categories', 'averageRating', 'ratingText', 'ratingColor'));
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

    public function viewFeedback(){

    }
}
