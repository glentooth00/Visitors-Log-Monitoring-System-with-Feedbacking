@extends('layouts.app') <!-- Change this if your layout is different -->

@section('title', 'Offices')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">List of Offices</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Office Name</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offices as $index => $office)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $office->office_name }}</td>
                            <td class="text-end">
                                <a href="{{ route('offices.feedback', $office->office_name) }}" class="btn btn-sm btn-outline-primary">
                                    View Office Feedbacks
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No offices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
