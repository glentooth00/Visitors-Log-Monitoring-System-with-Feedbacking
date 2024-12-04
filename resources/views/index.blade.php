@extends('layouts.appVisitor')

@section('title', 'Visitors Log')

@section('content')
    <a href="{{ route('login.user') }}" class="p-2 pt-2">Login</a>
    <div class="container pt-5">

        <h1>Visitor List</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Add Visitor Button Aligned to the Right -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0"></h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#visitorModal">
                Add Visitor
            </button>
        </div>

        <!-- Visitor Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Purpose</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $visitor->visitor_name }}</td>
                        <td>{{ $visitor->visitor_phone_no }}</td>
                        <td>{{ $visitor->visitor_purpose }}</td>
                        <td>
                            @if ($visitor->barangay)
                                Brgy. {{ $visitor->barangay->barangay_name }},
                            @endif
                            @if ($visitor->municipality)
                                {{ $visitor->municipality->municipality_name }},
                            @endif
                            @if ($visitor->province)
                                {{ $visitor->province->province_name }}
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm feedback-btn" data-id="{{ $visitor->id }}"
                                data-date="" data-time="" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                Feedback
                            </button>

                        </td>



                    </tr>
                @endforeach
            </tbody>
        </table>



        <!-- Visitor Modal -->
        <div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visitorModalLabel">Add Visitor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('store.visitor') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Full Name</label>
                                <input type="text" name="visitor_name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="visitor_phone_no" id="phone" class="form-control" required>
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
                                            <option value="{{ $municipality->id }}">{{ $municipality->municipality_name }}
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
                            <div class="form-group mb-3">
                                <label for="visit_time">Time of Visit</label>
                                <input type="time" name="visit_time" id="visit_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Feedback modal -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Visitor Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Visitor ID: <span id="visitorId"></span></p>
                        <p>Current Time: <span id="visitTime"></span></p>
                        <!-- Hidden inputs -->
                        <input type="hidden" id="hiddenDate" name="visit_date">
                        <input type="hidden" id="hiddenTime" name="visit_time">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Submit Feedback</button>
                    </div>
                </div>
            </div>
        </div>







    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
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


    document.addEventListener('DOMContentLoaded', function() {
        const feedbackButtons = document.querySelectorAll('.feedback-btn');
        const visitorIdSpan = document.getElementById('visitorId');
        const visitTimeSpan = document.getElementById('visitTime');
        const hiddenDateInput = document.getElementById('hiddenDate');
        const hiddenTimeInput = document.getElementById('hiddenTime');

        feedbackButtons.forEach(button => {
            button.addEventListener('click', function() {
                const visitorId = this.getAttribute('data-id');

                // Get current date and time in Philippine timezone
                const now = new Date();
                const phDate = now.toLocaleDateString('en-US', {
                    timeZone: 'Asia/Manila',
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit',
                });
                const phTime = now.toLocaleTimeString('en-US', {
                    timeZone: 'Asia/Manila',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true,
                });

                // Update button data attributes
                this.setAttribute('data-date', phDate);
                this.setAttribute('data-time', phTime);

                // Display in modal
                visitorIdSpan.textContent = visitorId;
                visitTimeSpan.textContent = `${phDate} ${phTime}`;

                // Update hidden inputs
                hiddenDateInput.value = phDate;
                hiddenTimeInput.value = phTime;
            });
        });
    });
</script>
