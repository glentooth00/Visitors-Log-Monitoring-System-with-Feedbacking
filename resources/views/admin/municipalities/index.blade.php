@extends('layouts.app')

@section('title', 'Municipalities')

@section('content')
    <div class="container-fluid">
        <h1>Municipality Management</h1>
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
                        <h4>Add New Municipality</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.municipality') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="municipality_name" class="form-label">Municipality Name</label>
                                <input type="text" class="form-control" id="municipality_name" name="municipality_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="province_id" class="form-label">Province</label>
                                <select class="form-select form-control" id="province_id" name="province_id" required>
                                    <option value="" hidden>Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Municipality</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section (Right Side) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Municipalities List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Municipality Name</th>
                                    <th>Province</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($municipalities as $municipality)
                                    <tr>
                                        <td>{{ $loop->iteration + ($municipalities->currentPage() - 1) * $municipalities->perPage() }}</td>
                                        <td>{{ $municipality->municipality_name }}</td>
                                        <td>{{ $municipality->province->province_name }}</td>
                                        <td>
                                            {{-- Uncomment and add routes for Edit/Delete as needed --}}
                                            {{-- <a href="{{ route('municipality.edit', $municipality->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('municipality.destroy', $municipality->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No municipalities found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <div>
                                <!-- Placeholder for any additional content -->
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="">
                                    {{ $municipalities->links() }}
                                </div>
                                &nbsp;
                                &nbsp; 
                                <p class="mb-0 me-3">
                                    Page {{ $municipalities->currentPage() }} of 
                                    {{ $municipalities->hasMorePages() ? $municipalities->currentPage() + 1 : $municipalities->currentPage() }}
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
