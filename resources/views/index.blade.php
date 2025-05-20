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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $visitor->visitor_name }}</td>
                        @php
                            $office = json_decode($visitor->office, true);
                        @endphp

                        <td>{{ is_array($office) ? implode(', ', $office) : $visitor->office }}</td>





                        {{-- <td>{{ $visitor->client_type }}</td>
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
                        </td> --}}
                        <td>

                            @if (empty($visitor->feedback_status))


                            <div class="d-flex gap-2" style="width:20em;">
                                 <button class="btn btn-success btn-sm feedback-btn" data-id="{{ $visitor->id }}"
                                    data-date="{{ $visitor->visit_date }}" data-time="{{ $visitor->visit_time }}"
                                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                    Feedback
                                </button>

                                 <button class="btn btn-dark btn-sm feedback-btn"
                                        data-id="{{ $visitor->id }}"
                                        data-date="{{ $visitor->visit_date }}"
                                        data-time="{{ $visitor->visit_time }}"
                                        data-offices='@json(json_decode($visitor->office))'
                                        data-bs-toggle="modal"
                                        data-bs-target="#officeModal">
                                    Submit Office Feedback
                                </button>

                            </div>



                            @else
                                <span class="display-3 badge badge-success text-submitted"
                                    style="font-size: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                    Feedback submitted
                                </span>
                            @endif



                            {{-- @foreach ($feedbacks as $feedback)
                                @if ($feedback->status == 1)
                                    <span class="display-3 badge badge-success text-submitted"
                                        style="font-size: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                        Feedback submitted
                                    </span>
                                @else
                                    <button class="btn btn-success btn-sm feedback-btn" data-id="{{ $visitor->id }}"
                                        data-date="{{ $visitor->visit_date }}" data-time="{{ $visitor->visit_time }}"
                                        data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                        Feedback
                                    </button>
                                @endif
                            @endforeach --}}
                        </td>




                    </tr>
                @endforeach
            </tbody>
        </table>


        <!--office Modal -->
<!-- Office Modal -->
<div class="modal fade" id="officeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Office Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('submit.feedback') }}" method="POST">
          @csrf
          <input type="hidden" name="visitor_id" value="{{ $visitor->id }}">
          <input type="hidden" name="visit_date" value="{{ $visitor->visit_date }}">
          <input type="hidden" name="visit_time" value="{{ $visitor->visit_time }}">

          <table class="table table-bordered text-center">
            <thead class="table-light">
              <tr>
                <th>Office</th>
                <th>5</th>
                <th>4</th>
                <th>3</th>
                <th>2</th>
                <th>1</th>
              </tr>
            </thead>
            <tbody id="ratingTableBody">
              @foreach (json_decode($visitor->office) as $office)
                <tr>
                  <td>{{ $office }}</td>
                  <td><input type="radio" name="rating[{{ $office }}]" value="5"></td>
                  <td><input type="radio" name="rating[{{ $office }}]" value="4"></td>
                  <td><input type="radio" name="rating[{{ $office }}]" value="3"></td>
                  <td><input type="radio" name="rating[{{ $office }}]" value="2"></td>
                  <td><input type="radio" name="rating[{{ $office }}]" value="1"></td>
                </tr>
              @endforeach
            </tbody>
          </table>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Feedback</button>
      </div>
    </form>
    </div>
  </div>
</div>




        {{-- modal form --}}
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

        {{-- <div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
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


                            <div class="row">

                                <div class="col-md-4">
                                    <label for="province">Province</label>
                                    <select name="province_id" id="province" class="form-control" required>
                                        <option value="" selected disabled hidden>Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


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

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}




        <!-- Feedback modal -->
        <!-- Feedback Modal -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="">
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



//office modal rating

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.feedback-btn').forEach(button => {
      button.addEventListener('click', function () {
        const offices = JSON.parse(this.getAttribute('data-offices') || '[]');
        const tbody = document.getElementById('ratingTableBody');
        tbody.innerHTML = ''; // Clear previous content

        if (offices.length === 0) {
          tbody.innerHTML = '<tr><td colspan="6">No office data available.</td></tr>';
          return;
        }

        offices.forEach((office, index) => {
          const tr = document.createElement('tr');

          let rowHTML = `<td><strong>${office}</strong></td>`;
          for (let point = 5; point >= 1; point--) {
            rowHTML += `
              <td>
                <input type="radio" name="ratings[${office}]" value="${point}" required>
              </td>`;
          }

          tr.innerHTML = rowHTML;
          tbody.appendChild(tr);
        });
      });
    });
  });




</script>

