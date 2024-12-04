@extends('layouts.app')

@section('title', 'Barangays')

@section('content')
    <div class="container-fluid">
        <h1>Barangay Management</h1>
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
                        <h4>Add New Barangay</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action=" {{ route('store.barangay') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="barangay_name" class="form-label">Barangay Name</label>
                                <input type="text" class="form-control" id="barangay_name" name="barangay_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="province_id" class="form-label">Province</label>
                                <select class="form-control" id="province_id" name="province_id" required>
                                    <option value="" disabled selected hidden>Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="municipality_id" class="form-label">Municipality</label>
                                <select class="form-control" id="municipality_id" name="municipality_id" required>
                                    <option value="" disabled selected hidden>Select Municipality</option>
                                    @foreach ($municipalities as $municipality)
                                        <option value="{{ $municipality->id }}">{{ $municipality->municipality_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Barangay</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section (Right Side) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Saved Barangays</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Barangay Name</th>
                                    <th>Municipality</th>
                                    <th>Province</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangays as $barangay)
                                    <tr>
                                        <td>{{ $loop->iteration + ($barangays->currentPage() - 1) * $barangays->perPage() }}
                                        </td>
                                        <td>{{ $barangay->barangay_name }}</td>
                                        <td>{{ $barangay->municipality->municipality_name }}</td>
                                        <td>{{ $barangay->municipality->province->province_name }}</td>
                                        <td>
                                            {{-- Uncomment and add routes for Edit/Delete as needed --}}
                                            {{-- <a href="{{ route('barangay.edit', $barangay->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('barangay.destroy', $barangay->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No barangays found.</td>
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
                                    {{ $barangays->links() }}
                                </div>
                                &nbsp;
                                &nbsp;
                                <p class="mb-0 me-3">
                                    Page {{ $barangays->currentPage() }} of
                                    {{ $barangays->hasMorePages() ? $barangays->currentPage() + 1 : $barangays->currentPage() }}
                                </p>
                            </div>
                        </div>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
