<?php

namespace App\Http\Controllers;

use App\Models\Barangays;
use App\Models\Feedback;
use App\Models\Municipalities;
use App\Models\Office;
use App\Models\Provinces;
use App\Models\Visitors;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */


     public function index()
{
    $visitorCount = Visitors::count();
    $Provinces = Provinces::get();

    $todayVisitors = Visitors::whereDate('created_at', Carbon::today())->get();
    $todayVisitorCount = $todayVisitors->count();

    // Additional summaries
    $visitorsPerOffice = Visitors::select('office', DB::raw('count(*) as total'))
                        ->groupBy('office')
                        ->orderBy('total', 'desc')
                        ->get();

    $visitorsPerProvince = Visitors::select('province_id', DB::raw('count(*) as total'))
                        ->groupBy('province_id')
                        ->orderBy('total', 'desc')
                        ->get();

    $visitorsPerClientType = Visitors::select('client_type', DB::raw('count(*) as total'))
                        ->groupBy('client_type')
                        ->orderBy('total', 'desc')
                        ->get();

    $monthlyVisitors = Visitors::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->groupBy('month')
    ->orderBy('month')
    ->get();


    return view('admin.dashboard', [
        'visitorCount' => $visitorCount,
        'Provinces' => $Provinces,
        'todayVisitors' => $todayVisitors,
        'todayVisitorCount' => $todayVisitorCount,
        'visitorsPerOffice' => $visitorsPerOffice,
        'visitorsPerProvince' => $visitorsPerProvince,
        'visitorsPerClientType' => $visitorsPerClientType,
        'monthlyVisitors'=> $monthlyVisitors,
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
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
