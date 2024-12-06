@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="row">
            <!-- Visitors Count Card -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Visitors</h5>
                        <p class="card-text display-4">{{ $visitorCount }}</p>
                    </div>
                </div>
            </div>
            {{--  --}}


        </div>
    </div>
@endsection
