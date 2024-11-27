@extends('layouts.appVisitor')

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
                <th>Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Purpose</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $visitor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $visitor->visitor_name }}</td>
                <td>{{ $visitor->visitor_phone_no }}</td>
                <td>{{ $visitor->visitor_purpose }}</td>
                <td>{{ $visitor->visit_date }}</td>
                <td>
                    <button class="btn btn-success btn-sm">Feedback</button>
                    {{-- <button class="btn btn-danger btn-sm">Delete</button> --}}
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
                        <div class="form-group mb-3">
                            <label for="country">Country</label>
                            <select name="visitor_country" id="country" class="form-control" required>
                                <option value="Philippines" selected>Philippines</option>
                            </select>
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
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
        // load region
        let dropdown = $('#region');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Choose Region</option>');
    dropdown.prop('selectedIndex', 0);
    const url = 'ph-json/region.json';
    // Populate dropdown with list of regions
    $.getJSON(url, function (data) {
        $.each(data, function (key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
        })
    });
    
</script>

