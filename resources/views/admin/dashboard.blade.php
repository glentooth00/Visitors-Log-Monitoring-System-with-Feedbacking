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
                            <th>Client Type</th>
                            <th>Action</th>
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
                                <td>{{ $visitor->client_type }}</td>
                                <td>
                                    @if (empty($visitor->feedback_status))
                                <button class="btn btn-success btn-sm feedback-btn" data-id="{{ $visitor->id }}"
                                    data-date="{{ $visitor->visit_date }}" data-time="{{ $visitor->visit_time }}"
                                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                    Feedback
                                </button>
                            @else
                                <span class="display-3 badge badge-success text-submitted"
                                    style="font-size: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                    Feedback submitted
                                </span>
                            @endif
                                </td>
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

        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('feedback.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Visitor Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Visitor ID: <span id="visitorId"></span></p>
                        <p>Current Time: <span id="visitTime"></span></p>

                        <!-- Hidden Inputs -->
                        <input type="hidden" id="visitorIdInput" name="visitor_id">
                        <input type="hidden" id="hiddenDate" name="visit_date">
                        <input type="hidden" id="hiddenTime" name="visit_time">

                        <!-- Feedback Table -->
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Feedback Category</th>
                                        <th>5</th>
                                        <th>4</th>
                                        <th>3</th>
                                        <th>2</th>
                                        <th>1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Staff Personnel Section -->
                                    <tr class="table-primary">
                                        <td colspan="7"><strong>Staff Personnel</strong></td>
                                    </tr>
                                    @foreach (['Attentiveness' => 'attentiveness', 'Courtesy' => 'courtesy', 'Friendliness' => 'friendliness', 'Helpful' => 'helpfulness', 'Knowledge' => 'knowledge', 'Promptness' => 'promptness'] as $label => $field)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $label }}</td>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <td>
                                                    <input type="radio" name="{{ $field }}"
                                                        value="{{ $i }}">
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach

                                    <!-- Service Section -->
                                    <tr class="table-primary">
                                        <td colspan="7"><strong>Service</strong></td>
                                    </tr>
                                    @foreach (['Quality of Service' => 'quality_of_service', 'Speed of Service' => 'speed_of_service'] as $label => $field)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $label }}</td>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <td>
                                                    <input type="radio" name="{{ $field }}"
                                                        value="{{ $i }}">
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach

                                    <!-- Facilities/Amenities Section -->
                                    <tr class="table-primary">
                                        <td colspan="7"><strong>Facilities/Amenities</strong></td>
                                    </tr>
                                    @foreach (['Quality of Facilities' => 'quality_of_facilities', 'Availability of Facilities/Amenities' => 'availability_of_facilities', 'Cleanliness' => 'cleanliness'] as $label => $field)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $label }}</td>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <td>
                                                    <input type="radio" name="{{ $field }}"
                                                        value="{{ $i }}">
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Comments/Suggestions -->
                        <div class="mt-3">
                            <label for="comments" class="form-label"><strong>Comments/Suggestions</strong></label>
                            <textarea class="form-control" id="comments" name="comments" rows="4"
                                placeholder="Enter your comments or suggestions here"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    </div>
@endsection
<script>
       document.addEventListener('DOMContentLoaded', () => {
        const feedbackModal = document.getElementById('feedbackModal');

        feedbackModal.addEventListener('show.bs.modal', (event) => {
            // Get the button that triggered the modal
            const button = event.relatedTarget;

            // Extract visitor ID and any other data attributes
            const visitorId = button.getAttribute('data-id');
            const visitDate = button.getAttribute('data-date');
            const visitTime = button.getAttribute('data-time');

            // Populate the modal with the extracted data
            document.getElementById('visitorId').textContent = visitorId;
            document.getElementById('visitorIdInput').value = visitorId;

            // Optionally set date/time if provided
            if (visitDate) document.getElementById('hiddenDate').value = visitDate;
            if (visitTime) document.getElementById('hiddenTime').value = visitTime;
        });
    });
</script>