<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfficeVisitor;
use Illuminate\Support\Carbon;

class VisitorController extends Controller
{
public function storeVisitor(Request $request)
{
    $validated = $request->validate([
        'client_type' => 'required|string',
        'visitor_name' => 'nullable|string|max:255',
        'office' => 'nullable|array',
        'attentiveness' =>  'nullable|string',
        'courtesy' => 'nullable|string',
        'friendliness' => 'nullable|string',
        'helpfulness' => 'nullable|string',
        'knowledge' => 'nullable|string',
        'promptness' => 'nullable|string',
        'quality_of_service' => 'nullable|string',
        'speed_of_service' => 'nullable|string',
        'quality_of_facilities' => 'nullable|string',
        'availability_of_facilities' => 'nullable|string',
        'cleanliness' => 'nullable|string',
        'comments' => 'nullable|string',
    ]);

    OfficeVisitor::create([
        'client_type' => $validated['client_type'],
        'visitor_name' => $validated['visitor_name'] ?? null,
        'offices' => isset($validated['office']) ? json_encode($validated['office']) : null,
        'attentiveness' => $validated['attentiveness'] ?? null,
        'courtesy' => $validated['courtesy'] ?? null,
        'friendliness' => $validated['friendliness'] ?? null,
        'helpfulness' => $validated['helpfulness'] ?? null,
        'knowledge' => $validated['knowledge'] ?? null,
        'promptness' => $validated['promptness'] ?? null,
        'quality_of_service' => $validated['quality_of_service'] ?? null,
        'speed_of_service' => $validated['speed_of_service'] ?? null,
        'quality_of_facilities' => $validated['quality_of_facilities'] ?? null,
        'availability_of_facilities' => $validated['availability_of_facilities'] ?? null,
        'cleanliness' => $validated['cleanliness'] ?? null,
        'comments' => $validated['comments'] ?? null,
        'visit_date' => Carbon::now()->format('Y-m-d'),
        'visit_time' => Carbon::now()->format('H:i:s'),
    ]);

    return redirect()->back()->with('success', 'Visitor logged successfully.');
}
}
