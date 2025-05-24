@extends('layouts.app')

@section('title', 'Visitors')
<!-- Add the custom CSS to your page or in a <style> tag -->
<style>
    /* Style for disabled but selected radio buttons (making them look active) */
    input[type="radio"]:disabled:checked {
        background-color: #007bff;
        /* Primary blue background */
        border-color: #007bff;
        /* Primary blue border */
        cursor: not-allowed;
        /* Show that the button is still disabled */
    }

    /* Default appearance for unselected disabled radio buttons */
    input[type="radio"]:disabled {
        cursor: not-allowed;
        /* Show that the button is disabled */
        background-color: #f0f0f0;
        /* Light gray background for unselected */
        border-color: #ccc;
        /* Light border for unselected disabled radio buttons */
    }

    /* Optional: Change color of the radio button itself (dot inside) for selected state */
    input[type="radio"]:disabled:checked::after {
        background-color: white;
        /* White dot for the checked state */
    }
</style>
@section('content')

    <div class="container-fluid">
        <h1>Visitors List</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Visitors Table -->
        <div class="card">
            <div class="card-header">
                <h4>All Visitors</h4>
            </div>
            <div class="card-body">

                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#visitorModal">
                    Add Visitor
                </button> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Visitor Name</th>
                            <th>Office Visited</th>
                            <th>Visit Date/Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visitors as $visitor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $visitor->visitor_name }}</td>
                                <td>{{ preg_replace('/[^a-zA-Z0-9, &]/', '', $visitor->offices) }}</td>


</td>
                                <td>{{ $visitor->created_at }}</td>
                                {{-- <td>{{ $visitor->visit_date->format('M-d-Y') }} / {{ $visitor->visit_time }}</td> --}}
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#viewVisitorModal" data-id="{{ $visitor->id }}"
                                        data-name="{{ $visitor->visitor_name }}"
                                        data-purpose="{{ $visitor->visitor_purpose }}"
                                        data-phone="{{ $visitor->visitor_phone_no }}"
                                        {{-- data-visit-date="{{ $visitor->visit_date->format('M-d-Y') }}" --}}
                                        {{-- data-visit-time="{{ $visitor->visit_time }}" --}}
                                        data-feedback="{{ $visitor->feedback ? json_encode($visitor->feedback->toArray()) : '{}' }}">
                                        View
                                    </button>

                                    @if (empty($visitor->feedback_status))
                                    {{-- <button class="btn btn-success btn-sm feedback-btn" data-id="{{ $visitor->id }}"
                                        data-date="{{ $visitor->visit_date }}" data-time="{{ $visitor->visit_time }}"
                                        data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                        Feedback
                                    </button> --}}
                                @else
                                    {{-- <span class="display-3 badge badge-success text-submitted"
                                        style="font-size: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                        Feedback submitted
                                    </span> --}}
                                @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- View Visitor Modal -->
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
                            <p><strong>Name:</strong><h3><span id="visitorName"></span></h3></p>
                            {{-- <p><strong>Purpose of Visit:</strong> <span id="visitorPurpose"></span></p> --}}
                        </div>
                        <div class="col-md-6">
                            {{-- <p><strong>Contact Number:</strong> <span id="visitorPhoneNo"></span></p>
                            <p><strong>Visit Date:</strong> <span id="visitorVisitDate"></span></p>
                            <p><strong>Visit Time:</strong> <span id="visitorVisitTime"></span></p> --}}
                        </div>
                    </div>

                    <!-- Feedback Table -->
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
            @php $index = 1; @endphp
            @foreach (['Attentiveness' => 'attentiveness', 'Courtesy' => 'courtesy', 'Friendliness' => 'friendliness', 'Helpful' => 'helpfulness', 'Knowledge' => 'knowledge', 'Promptness' => 'promptness'] as $label => $field)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $label }}</td>
                    @for ($i = 5; $i >= 1; $i--)
                        <td>
                            <input type="radio" name="{{ $field }}" value="{{ $i }}" disabled
                                {{ isset($visitor->{$field}) && $visitor->{$field} == $i ? 'checked' : '' }}>
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
                    <td>{{ $index++ }}</td>
                    <td>{{ $label }}</td>
                    @for ($i = 5; $i >= 1; $i--)
                        <td>
                            <input type="radio" name="{{ $field }}" value="{{ $i }}" disabled
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
                    <td>{{ $index++ }}</td>
                    <td>{{ $label }}</td>
                    @for ($i = 5; $i >= 1; $i--)
                        <td>
                            <input type="radio" name="{{ $field }}" value="{{ $i }}" disabled
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

@endsection

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

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener for each "View" button
            const viewButtons = document.querySelectorAll('.btn-info');

            viewButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get data from button attributes
                    const visitorId = button.getAttribute('data-id');
                    const visitorName = button.getAttribute('data-name');
                    const visitorPurpose = button.getAttribute('data-purpose');
                    const visitorPhone = button.getAttribute('data-phone');
                    const visitDate = button.getAttribute('data-visit-date');
                    const visitTime = button.getAttribute('data-visit-time');
                    const visitorFeedback = JSON.parse(button.getAttribute('data-feedback'));

                    // Get modal elements
                    const visitorIdElement = document.getElementById('visitorId');
                    const visitorNameElement = document.getElementById('visitorName');
                    const visitorPurposeElement = document.getElementById('visitorPurpose');
                    const visitorPhoneElement = document.getElementById('visitorPhoneNo');
                    const visitorVisitDateElement = document.getElementById('visitorVisitDate');
                    const visitorVisitTimeElement = document.getElementById('visitorVisitTime');
                    const visitorFeedbackElement = document.getElementById('visitorFeedback');

                    // Populate modal with data
                    visitorIdElement.textContent = visitorId;
                    visitorNameElement.textContent = visitorName;
                    visitorPurposeElement.textContent = visitorPurpose;
                    visitorPhoneElement.textContent = visitorPhone;
                    visitorVisitDateElement.textContent = visitDate;
                    visitorVisitTimeElement.textContent = visitTime;

                    // Set feedback data for radio buttons
                    Object.keys(visitorFeedback).forEach(function(field) {
                        const fieldValue = visitorFeedback[field];
                        if (fieldValue) {
                            const radioButton = document.querySelector(
                                `input[name="${field}"][value="${fieldValue}"]`);
                            if (radioButton) {
                                radioButton.checked = true;
                            }
                        }
                    });

                    // Set visitor feedback text
                    visitorFeedbackElement.value = visitorFeedback.comments || '';
                });
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
@endsection
