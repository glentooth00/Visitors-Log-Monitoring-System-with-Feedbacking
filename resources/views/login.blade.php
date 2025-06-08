<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors Log Monitoring System with Feedbacking - Login</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
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
    <div class="p-1 d-flex">
        <h5 class="badge text-white float-start">
 <a href="{{ route('visitor') }}">Login</a>
        </h5>
        <div>
{{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#visitorModal">
               Feedback
            </button> --}}
        </div>


    </div>
    <div class="container   d-flex flex-column justify-content-center align-items-center" style="margin-top: 1em;width:50em;">
        <!-- System Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">Visitors Management System</h1>
            <h2 class="fw-bold">with Feedbacking</h2>
        </div>

        <!-- Login Form -->
        <div class="card p-4 shadow-lg" style="width: 900px;">
  <form action="{{ route('store.rating') }}" method="POST">
                        @csrf
                        <div class="">

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
                                <label for="name">Full Name<span class="badge text-muted">(optional)</span></label>
                                <input type="text" name="visitor_name" id="name" class="form-control">
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="visitor_phone_no" id="phone" class="form-control" required>
                            </div> --}}

                            <!-- Offices Section -->
                           <div class="form-group mb-3">
                                <label>Offices</label>
                                <div class="d-flex flex-wrap">

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office1" name="office[]" value="Campus Administrator">
                                        <label class="form-check-label" for="office1">Campus Administrator</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office2" name="office[]" value="Safety Officer">
                                        <label class="form-check-label" for="office2">Safety Officer</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office3" name="office[]" value="Resource Generation Instruction">
                                        <label class="form-check-label" for="office3">Resource Generation Instruction</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office4" name="office[]" value="General Services">
                                        <label class="form-check-label" for="office4">General Services</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office5" name="office[]" value="Human Resources">
                                        <label class="form-check-label" for="office5">Human Resources</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office6" name="office[]" value="Quality Assurance">
                                        <label class="form-check-label" for="office6">Quality Assurance</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office7" name="office[]" value="Alumni">
                                        <label class="form-check-label" for="office7">Alumni</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office8" name="office[]" value="Library">
                                        <label class="form-check-label" for="office8">Library</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office9" name="office[]" value="Canteen">
                                        <label class="form-check-label" for="office9">Canteen</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office10" name="office[]" value="Student Affairs">
                                        <label class="form-check-label" for="office10">Student Affairs</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office11" name="office[]" value="Accounting">
                                        <label class="form-check-label" for="office11">Accounting</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office12" name="office[]" value="Extension & Linkages">
                                        <label class="form-check-label" for="office12">Extension & Linkages</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office13" name="office[]" value="Research and Development">
                                        <label class="form-check-label" for="office13">Research and Development</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office14" name="office[]" value="Cashier">
                                        <label class="form-check-label" for="office14">Cashier</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office15" name="office[]" value="MIS & DPO">
                                        <label class="form-check-label" for="office15">MIS & DPO</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office16" name="office[]" value="Registrar">
                                        <label class="form-check-label" for="office16">Registrar</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office17" name="office[]" value="Supply">
                                        <label class="form-check-label" for="office17">Supply</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office18" name="office[]" value="Medical and Dental">
                                        <label class="form-check-label" for="office18">Medical and Dental</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office19" name="office[]" value="Guidance">
                                        <label class="form-check-label" for="office19">Guidance</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office20" name="office[]" value="Dean">
                                        <label class="form-check-label" for="office20">Dean</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office21" name="office[]" value="Population Control Officer">
                                        <label class="form-check-label" for="office21">Population Control Officer</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office22" name="office[]" value="Security">
                                        <label class="form-check-label" for="office22">Security</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office23" name="office[]" value="Publication">
                                        <label class="form-check-label" for="office23">Publication</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office24" name="office[]" value="Ojt Office">
                                        <label class="form-check-label" for="office24">Ojt Office</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office25" name="office[]" value="Planning Programming Development">
                                        <label class="form-check-label" for="office25">Planning Programming Development</label>
                                    </div>

                                </div>
                            </div>

                            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
    <thead>
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%;">#</th>
            <th style="text-align: left;">Feedback Category</th>
            <th>5</th>
            <th>4</th>
            <th>3</th>
            <th>2</th>
            <th>1</th>
        </tr>
    </thead>
    <tbody>
        <tr style="background-color: #cfe2ff; font-weight: bold;">
            <td colspan="7" style="text-align: left;">Staff Personnel</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left;">Attentiveness</td>
            <td><input type="radio" name="attentiveness" value="5"></td>
            <td><input type="radio" name="attentiveness" value="4"></td>
            <td><input type="radio" name="attentiveness" value="3"></td>
            <td><input type="radio" name="attentiveness" value="2"></td>
            <td><input type="radio" name="attentiveness" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left;">Courtesy</td>
            <td><input type="radio" name="courtesy" value="5"></td>
            <td><input type="radio" name="courtesy" value="4"></td>
            <td><input type="radio" name="courtesy" value="3"></td>
            <td><input type="radio" name="courtesy" value="2"></td>
            <td><input type="radio" name="courtesy" value="1"></td>
        </tr>
        <tr>
            <td>3</td>
            <td style="text-align: left;">Friendliness</td>
            <td><input type="radio" name="friendliness" value="5"></td>
            <td><input type="radio" name="friendliness" value="4"></td>
            <td><input type="radio" name="friendliness" value="3"></td>
            <td><input type="radio" name="friendliness" value="2"></td>
            <td><input type="radio" name="friendliness" value="1"></td>
        </tr>
        <tr>
            <td>4</td>
            <td style="text-align: left;">Helpful</td>
            <td><input type="radio" name="helpfulness" value="5"></td>
            <td><input type="radio" name="helpfulness" value="4"></td>
            <td><input type="radio" name="helpfulness" value="3"></td>
            <td><input type="radio" name="helpfulness" value="2"></td>
            <td><input type="radio" name="helpfulness" value="1"></td>
        </tr>
        <tr>
            <td>5</td>
            <td style="text-align: left;">Knowledge</td>
            <td><input type="radio" name="knowledge" value="5"></td>
            <td><input type="radio" name="knowledge" value="4"></td>
            <td><input type="radio" name="knowledge" value="3"></td>
            <td><input type="radio" name="knowledge" value="2"></td>
            <td><input type="radio" name="knowledge" value="1"></td>
        </tr>
        <tr>
            <td>6</td>
            <td style="text-align: left;">Promptness</td>
            <td><input type="radio" name="promptness" value="5"></td>
            <td><input type="radio" name="promptness" value="4"></td>
            <td><input type="radio" name="promptness" value="3"></td>
            <td><input type="radio" name="promptness" value="2"></td>
            <td><input type="radio" name="promptness" value="1"></td>
        </tr>

        <tr style="background-color: #cfe2ff; font-weight: bold;">
            <td colspan="7" style="text-align: left;">Service</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left;">Quality of Service</td>
            <td><input type="radio" name="quality_of_service" value="5"></td>
            <td><input type="radio" name="quality_of_service" value="4"></td>
            <td><input type="radio" name="quality_of_service" value="3"></td>
            <td><input type="radio" name="quality_of_service" value="2"></td>
            <td><input type="radio" name="quality_of_service" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left;">Speed of Service</td>
            <td><input type="radio" name="speed_of_service" value="5"></td>
            <td><input type="radio" name="speed_of_service" value="4"></td>
            <td><input type="radio" name="speed_of_service" value="3"></td>
            <td><input type="radio" name="speed_of_service" value="2"></td>
            <td><input type="radio" name="speed_of_service" value="1"></td>
        </tr>

        <tr style="background-color: #cfe2ff; font-weight: bold;">
            <td colspan="7" style="text-align: left;">Facilities/Amenities</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left;">Quality of Facilities</td>
            <td><input type="radio" name="quality_of_facilities" value="5"></td>
            <td><input type="radio" name="quality_of_facilities" value="4"></td>
            <td><input type="radio" name="quality_of_facilities" value="3"></td>
            <td><input type="radio" name="quality_of_facilities" value="2"></td>
            <td><input type="radio" name="quality_of_facilities" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left;">Availability of Facilities/Amenities</td>
            <td><input type="radio" name="availability_of_facilities" value="5"></td>
            <td><input type="radio" name="availability_of_facilities" value="4"></td>
            <td><input type="radio" name="availability_of_facilities" value="3"></td>
            <td><input type="radio" name="availability_of_facilities" value="2"></td>
            <td><input type="radio" name="availability_of_facilities" value="1"></td>
        </tr>
        <tr>
            <td>3</td>
            <td style="text-align: left;">Cleanliness</td>
            <td><input type="radio" name="cleanliness" value="5"></td>
            <td><input type="radio" name="cleanliness" value="4"></td>
            <td><input type="radio" name="cleanliness" value="3"></td>
            <td><input type="radio" name="cleanliness" value="2"></td>
            <td><input type="radio" name="cleanliness" value="1"></td>
        </tr>
    </tbody>
</table>
<br>
                            {{-- <div class="form-group mb-3">
                                <label for="purpose">Purpose of Visit</label>
                                <textarea name="visitor_purpose" id="purpose" class="form-control" rows="3" required></textarea>
                            </div> --}}
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


 <div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visitorModalLabel">Add Visitor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('store.rating') }}" method="POST">
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
                                <label for="name">Full Name<span class="badge text-muted">(optional)</span></label>
                                <input type="text" name="visitor_name" id="name" class="form-control" required>
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="visitor_phone_no" id="phone" class="form-control" required>
                            </div> --}}

                            <!-- Offices Section -->
                           <div class="form-group mb-3">
                                <label>Offices</label>
                                <div class="d-flex flex-wrap">

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office1" name="office[]" value="Campus Administrator">
                                        <label class="form-check-label" for="office1">Campus Administrator</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office2" name="office[]" value="Safety Officer">
                                        <label class="form-check-label" for="office2">Safety Officer</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office3" name="office[]" value="Resource Generation Instruction">
                                        <label class="form-check-label" for="office3">Resource Generation Instruction</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office4" name="office[]" value="General Services">
                                        <label class="form-check-label" for="office4">General Services</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office5" name="office[]" value="Human Resources">
                                        <label class="form-check-label" for="office5">Human Resources</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office6" name="office[]" value="Quality Assurance">
                                        <label class="form-check-label" for="office6">Quality Assurance</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office7" name="office[]" value="Alumni">
                                        <label class="form-check-label" for="office7">Alumni</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office8" name="office[]" value="Library">
                                        <label class="form-check-label" for="office8">Library</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office9" name="office[]" value="Canteen">
                                        <label class="form-check-label" for="office9">Canteen</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office10" name="office[]" value="Student Affairs">
                                        <label class="form-check-label" for="office10">Student Affairs</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office11" name="office[]" value="Accounting">
                                        <label class="form-check-label" for="office11">Accounting</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office12" name="office[]" value="Extension & Linkages">
                                        <label class="form-check-label" for="office12">Extension & Linkages</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office13" name="office[]" value="Research and Development">
                                        <label class="form-check-label" for="office13">Research and Development</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office14" name="office[]" value="Cashier">
                                        <label class="form-check-label" for="office14">Cashier</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office15" name="office[]" value="MIS & DPO">
                                        <label class="form-check-label" for="office15">MIS & DPO</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office16" name="office[]" value="Registrar">
                                        <label class="form-check-label" for="office16">Registrar</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office17" name="office[]" value="Supply">
                                        <label class="form-check-label" for="office17">Supply</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office18" name="office[]" value="Medical and Dental">
                                        <label class="form-check-label" for="office18">Medical and Dental</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office19" name="office[]" value="Guidance">
                                        <label class="form-check-label" for="office19">Guidance</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office20" name="office[]" value="Dean">
                                        <label class="form-check-label" for="office20">Dean</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office21" name="office[]" value="Population Control Officer">
                                        <label class="form-check-label" for="office21">Population Control Officer</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office22" name="office[]" value="Security">
                                        <label class="form-check-label" for="office22">Security</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office23" name="office[]" value="Publication">
                                        <label class="form-check-label" for="office23">Publication</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office24" name="office[]" value="Ojt Office">
                                        <label class="form-check-label" for="office24">Ojt Office</label>
                                    </div>

                                    <div class="form-check me-3">
                                        <input type="checkbox" class="form-check-input" id="office25" name="office[]" value="Planning Programming Development">
                                        <label class="form-check-label" for="office25">Planning Programming Development</label>
                                    </div>

                                </div>
                            </div>

                            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
    <thead>
        <tr style="background-color: #f0f0f0;">
            <th style="width: 5%;">#</th>
            <th style="text-align: left;">Feedback Category</th>
            <th>5</th>
            <th>4</th>
            <th>3</th>
            <th>2</th>
            <th>1</th>
        </tr>
    </thead>
    <tbody>
        <tr style="background-color: #cfe2ff; font-weight: bold;">
            <td colspan="7" style="text-align: left;">Staff Personnel</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left;">Attentiveness</td>
            <td><input type="radio" name="attentiveness" value="5"></td>
            <td><input type="radio" name="attentiveness" value="4"></td>
            <td><input type="radio" name="attentiveness" value="3"></td>
            <td><input type="radio" name="attentiveness" value="2"></td>
            <td><input type="radio" name="attentiveness" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left;">Courtesy</td>
            <td><input type="radio" name="courtesy" value="5"></td>
            <td><input type="radio" name="courtesy" value="4"></td>
            <td><input type="radio" name="courtesy" value="3"></td>
            <td><input type="radio" name="courtesy" value="2"></td>
            <td><input type="radio" name="courtesy" value="1"></td>
        </tr>
        <tr>
            <td>3</td>
            <td style="text-align: left;">Friendliness</td>
            <td><input type="radio" name="friendliness" value="5"></td>
            <td><input type="radio" name="friendliness" value="4"></td>
            <td><input type="radio" name="friendliness" value="3"></td>
            <td><input type="radio" name="friendliness" value="2"></td>
            <td><input type="radio" name="friendliness" value="1"></td>
        </tr>
        <tr>
            <td>4</td>
            <td style="text-align: left;">Helpful</td>
            <td><input type="radio" name="helpfulness" value="5"></td>
            <td><input type="radio" name="helpfulness" value="4"></td>
            <td><input type="radio" name="helpfulness" value="3"></td>
            <td><input type="radio" name="helpfulness" value="2"></td>
            <td><input type="radio" name="helpfulness" value="1"></td>
        </tr>
        <tr>
            <td>5</td>
            <td style="text-align: left;">Knowledge</td>
            <td><input type="radio" name="knowledge" value="5"></td>
            <td><input type="radio" name="knowledge" value="4"></td>
            <td><input type="radio" name="knowledge" value="3"></td>
            <td><input type="radio" name="knowledge" value="2"></td>
            <td><input type="radio" name="knowledge" value="1"></td>
        </tr>
        <tr>
            <td>6</td>
            <td style="text-align: left;">Promptness</td>
            <td><input type="radio" name="promptness" value="5"></td>
            <td><input type="radio" name="promptness" value="4"></td>
            <td><input type="radio" name="promptness" value="3"></td>
            <td><input type="radio" name="promptness" value="2"></td>
            <td><input type="radio" name="promptness" value="1"></td>
        </tr>

        <tr style="background-color: #cfe2ff; font-weight: bold;">
            <td colspan="7" style="text-align: left;">Service</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left;">Quality of Service</td>
            <td><input type="radio" name="quality_of_service" value="5"></td>
            <td><input type="radio" name="quality_of_service" value="4"></td>
            <td><input type="radio" name="quality_of_service" value="3"></td>
            <td><input type="radio" name="quality_of_service" value="2"></td>
            <td><input type="radio" name="quality_of_service" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left;">Speed of Service</td>
            <td><input type="radio" name="speed_of_service" value="5"></td>
            <td><input type="radio" name="speed_of_service" value="4"></td>
            <td><input type="radio" name="speed_of_service" value="3"></td>
            <td><input type="radio" name="speed_of_service" value="2"></td>
            <td><input type="radio" name="speed_of_service" value="1"></td>
        </tr>

        <tr style="background-color: #cfe2ff; font-weight: bold;">
            <td colspan="7" style="text-align: left;">Facilities/Amenities</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left;">Quality of Facilities</td>
            <td><input type="radio" name="quality_of_facilities" value="5"></td>
            <td><input type="radio" name="quality_of_facilities" value="4"></td>
            <td><input type="radio" name="quality_of_facilities" value="3"></td>
            <td><input type="radio" name="quality_of_facilities" value="2"></td>
            <td><input type="radio" name="quality_of_facilities" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left;">Availability of Facilities/Amenities</td>
            <td><input type="radio" name="availability_of_facilities" value="5"></td>
            <td><input type="radio" name="availability_of_facilities" value="4"></td>
            <td><input type="radio" name="availability_of_facilities" value="3"></td>
            <td><input type="radio" name="availability_of_facilities" value="2"></td>
            <td><input type="radio" name="availability_of_facilities" value="1"></td>
        </tr>
        <tr>
            <td>3</td>
            <td style="text-align: left;">Cleanliness</td>
            <td><input type="radio" name="cleanliness" value="5"></td>
            <td><input type="radio" name="cleanliness" value="4"></td>
            <td><input type="radio" name="cleanliness" value="3"></td>
            <td><input type="radio" name="cleanliness" value="2"></td>
            <td><input type="radio" name="cleanliness" value="1"></td>
        </tr>
    </tbody>
</table>
<br>
                            {{-- <div class="form-group mb-3">
                                <label for="purpose">Purpose of Visit</label>
                                <textarea name="visitor_purpose" id="purpose" class="form-control" rows="3" required></textarea>
                            </div> --}}
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
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>
