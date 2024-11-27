@extends('layouts.app')

@section('title', 'Provinces')

@section('content')
    <div class="container-fluid">
        <h1>Province Management</h1>
        <hr>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
        <div class="row">
            <!-- Form Section (Left Side) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Province</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.province') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="province_name" class="form-label">Province Name</label>
                                <input type="text" class="form-control" id="province_name" name="province_name" required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="region" class="form-label">Region</label>
                                <input type="text" class="form-control" id="region" name="region" required>
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Add Province</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section (Right Side) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Saved Provinces</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Province Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provinces as $province)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $province->province_name }}</td>
                                        <td>
                                            {{-- <a href="{{ route('province.edit', $province->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('province.destroy', $province->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
