@extends('layouts.app')

@section('title', 'Feedback')

@section('content')
    <div class="container-fluid">
        <h1>Feedback Management</h1>
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
                        <h4>Add Feedback</h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('store.feedback') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="feedback_title" class="form-label">Feedback item</label>
                                <input type="text" class="form-control" id="feedback_item" name="feedback_title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="feedback_point" class="form-label">Feedback Point</label>
                                <input type="number" class="form-control" id="feedback_point" name="feedback_point"
                                    required>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section (Right Side) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Submitted Feedback</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Uncomment when data is available --}}
                                {{-- @forelse ($feedbacks as $feedback) --}}
                                <tr>
                                    {{-- <td>{{ $loop->iteration + ($feedbacks->currentPage() - 1) * $feedbacks->perPage() }}</td> --}}
                                    {{-- <td>{{ $feedback->title }}</td> --}}
                                    {{-- <td>{{ $feedback->description }}</td> --}}
                                    <td>
                                        {{-- {{ route('feedback.edit', $feedback->id) }} --}}
                                        {{-- <a href="" class="btn btn-warning btn-sm">Edit</a> --}}
                                        {{-- {{ route('feedback.destroy', $feedback->id) }} --}}
                                        {{-- <form action="" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                                {{-- @empty --}}
                                <tr>
                                    <td colspan="5" class="text-center">No feedback found.</td>
                                </tr>
                                {{-- @endforelse --}}
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
                                    {{-- {{ $feedbacks->links() }} --}}
                                </div>
                                &nbsp;
                                &nbsp;
                                <p class="mb-0 me-3">
                                    {{-- Uncomment for dynamic pagination details --}}
                                    {{-- Page {{ $feedbacks->currentPage() }} of {{ $feedbacks->lastPage() }} --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
