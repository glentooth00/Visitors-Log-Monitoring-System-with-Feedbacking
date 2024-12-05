@extends('layouts.app')

@section('title', 'Offices')

@section('content')
    <div class="container-fluid">
        <h1>Office Management</h1>
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
                        <h4>Add New Office</h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action=" {{ route('store.office') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="office_name" class="form-label">Office Name</label>
                                <input type="text" class="form-control" id="office_name" name="office_name" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Office</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section (Right Side) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Saved Offices</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Office Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Uncomment when data is available --}}
                                @forelse ($offices as $office)
                                    <tr>
                                        <td>{{ $loop->iteration + ($offices->currentPage() - 1) * $offices->perPage() }}
                                        </td>
                                        <td>{{ $office->office_name }}</td>
                                        <td>
                                            {{-- {{ route('office.edit', $office->id) }} --}}
                                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                                            {{-- {{ route('office.destroy', $office->id) }} --}}
                                            <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No offices found.</td>
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
                                    {{-- Uncomment for dynamic pagination --}}
                                    {{ $offices->links() }}
                                </div>
                                &nbsp;
                                &nbsp;
                                <p class="mb-0 me-3">
                                    {{-- Uncomment for dynamic pagination details --}}
                                    Page {{ $offices->currentPage() }} of
                                    {{ $offices->hasMorePages() ? $offices->currentPage() + 1 : $offices->currentPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
