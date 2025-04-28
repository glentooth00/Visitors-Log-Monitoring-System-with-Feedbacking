@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Admin Dashboard</h1>

        <div class="row mb-4">
            <!-- Today's Visitors Count Card -->
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Visitors Today</h5>
                        <p class="card-text display-4">{{ $todayVisitorCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Visitors Count Card -->
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Visitors</h5>
                        <p class="card-text display-4">{{ $visitorCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Table -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Today's Visitor Summary</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Visit Date</th>
                            <th>Visit Time</th>
                            <th>Office</th>
                            <th>Visitor Name</th>
                            <th>Visitor Phone No.</th>
                            <th>Visitor Purpose</th>
                            <th>Office of Transaction</th>
                            <th>Province</th>
                            <th>Municipality</th>
                            <th>Barangay</th>
                            <th>Feedback Status</th>
                            <th>Client Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($todayVisitors as $visitor)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('M d, Y') }}</td>
                                <td>{{ $visitor->visit_time }}</td>
                                <td>{{ $visitor->office }}</td>
                                <td>{{ $visitor->visitor_name }}</td>
                                <td>{{ $visitor->visitor_phone_no }}</td>
                                <td>{{ $visitor->visitor_purpose }}</td>
                                <td>{{ $visitor->office_of_transaction }}</td>
                                <td>{{ $visitor->province_id }}</td>
                                <td>{{ $visitor->municipality_id }}</td>
                                <td>{{ $visitor->barangay_id }}</td>
                                <td>{{ $visitor->feedback_status }}</td>
                                <td>{{ $visitor->client_type }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No visitors today.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
