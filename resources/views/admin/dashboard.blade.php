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

            <div class="p-2">
                {{-- <button class="btn btn-primary w-25 mt-2" data-bs-toggle="modal" data-bs-target="#visitorModal">
                    Add Visitor
                </button> --}}
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
                            <th>Client Type</th>
                            {{-- <th>Action</th> --}}
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
                                {{-- <button class="btn btn-success btn-sm feedback-btn" data-id="{{ $visitor->id }}"
                                    data-date="{{ $visitor->visit_date }}" data-time="{{ $visitor->visit_time }}"
                                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                    Feedback
                                </button> --}}
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


    <div class="modal fade" id="viewVisitorModal" tabindex="-1" aria-labelledby="viewVisitorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewVisitorModalLabel">Visitor Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Visitor ID -->
                    <p class="d-none"><strong>Visitor ID:</strong> <span id="visitorId"></span></p>

                    <!-- Use Bootstrap grid system to arrange the fields in 2 columns -->
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <span id="visitorName"></span></p>
                            <p><strong>Purpose of Visit:</strong> <span id="visitorPurpose"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Contact Number:</strong> <span id="visitorPhoneNo"></span></p>
                            <p><strong>Visit Date:</strong> <span id="visitorVisitDate"></span></p>
                            <p><strong>Visit Time:</strong> <span id="visitorVisitTime"></span></p>
                        </div>
                    </div>

                    <!-- Feedback Table -->
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
                                                value="{{ $i }}" disabled
                                                {{ isset($visitors->{$field}) && $visitors->{$field} == $i ? 'checked' : '' }}>
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
                                                value="{{ $i }}" disabled
                                                {{ isset($visitor->{$field}) && $visitor->{$field} == $i ? 'checked' : '' }}>
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
                                                value="{{ $i }}" disabled
                                                {{ isset($visitor->{$field}) && $visitor->{$field} == $i ? 'checked' : '' }}>
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
                        <textarea class="form-control" id="visitorFeedback" name="comments" rows="4"
                            placeholder="Enter your comments or suggestions here" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-success">Submit Feedback</button> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitorModalLabel">Add Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store.visitor') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label for="name">Clients</label><br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="client_type" value="Alumni"
                                    required>
                                <label class="form-check-label">Alumni</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="client_type" value="Old Student"
                                    required>
                                <label class="form-check-label">Old Student</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="client_type" value="Parent"
                                    required>
                                <label class="form-check-label">Parent</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="client_type" value="Guardian"
                                    required>
                                <label class="form-check-label">Guardian</label>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" name="visitor_name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="visitor_phone_no" id="phone" class="form-control" required>
                        </div>

                        <!-- Offices Section -->
                        <div class="form-group mb-3">
                            <label>Offices</label>
                            <div class="d-flex flex-wrap">
                                @foreach ($offices as $office)
                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office_{{ $office->id }}"
                                            name="office[]" value="{{ $office->office_name }}">
                                        <label class="form-check-label"
                                            for="office_{{ $office->id }}">{{ $office->office_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Row for dropdowns -->
                        <div class="row">
                            <!-- Province Dropdown -->
                            <div class="col-md-4">
                                <label for="province">Province</label>
                                <select name="province_id" id="province" class="form-control" required>
                                    <option value="" selected disabled hidden>Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Municipality Dropdown -->
                            <div class="col-md-4">
                                <label for="municipality">Municipality</label>
                                <select name="municipality_id" id="municipality" class="form-control" required>
                                    <option value="" selected disabled hidden>Select Municipality</option>
                                    @foreach ($municipalities as $municipality)
                                        <option value="{{ $municipality->id }}">
                                            {{ $municipality->municipality_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Barangay Dropdown -->
                            <div class="col-md-4">
                                <label for="barangay">Barangay</label>
                                <select name="barangay_id" id="barangay" class="form-control" required>
                                    <option value="" selected disabled hidden>Select Barangay</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purpose">Purpose of Visit</label>
                            <textarea name="visitor_purpose" id="purpose" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="visit_date">Date of Visit</label>
                            <input type="date" name="visit_date" id="visit_date" class="form-control" required>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="visit_time">Time of Visit</label>
                            <input type="time" name="visit_time" id="visit_time" class="form-control" required>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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


            document.addEventListener('DOMContentLoaded', function() {
        const provinceDropdown = document.getElementById('province');

        if (provinceDropdown) {
            provinceDropdown.addEventListener('change', function() {
                const provinceId = this.value;
                const municipalityDropdown = document.getElementById('municipality');
                const barangayDropdown = document.getElementById('barangay');

                municipalityDropdown.innerHTML =
                    '<option value="" selected disabled>Select Municipality</option>';
                barangayDropdown.innerHTML =
                    '<option value="" selected disabled hidden>Select Barangay</option>';

                if (provinceId) {
                    fetch(`/get-municipalities?province_id=${provinceId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(municipality => {
                                const option = document.createElement('option');
                                option.value = municipality.id;
                                option.textContent = municipality.municipality_name;
                                municipalityDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching municipalities:', error));
                }
            });
        } else {
            console.error("Province dropdown element not found in the DOM.");
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const municipalityDropdown = document.getElementById('municipality');
        const barangayDropdown = document.getElementById('barangay');

        if (municipalityDropdown) {
            municipalityDropdown.addEventListener('change', function() {
                const municipalityId = this.value;

                // Clear existing barangay options
                barangayDropdown.innerHTML =
                    '<option value="" selected disabled hidden>Select Barangay</option>';

                if (municipalityId) {
                    fetch(`/get-barangays?municipality_id=${municipalityId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(barangay => {
                                const option = document.createElement('option');
                                option.value = barangay.id;
                                option.textContent = barangay.barangay_name;
                                barangayDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching barangays:', error));
                }
            });
        }
    });


</script>
