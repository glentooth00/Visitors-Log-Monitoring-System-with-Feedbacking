@extends('layouts.app')

@section('title', 'Feedback Details for ' . $feedback->visitor_name)

@section('content')
<div class="container mt-4">
    <h2>Feedback Details for {{ $feedback->visitor_name }}</h2>
    <p><strong>Submitted at:</strong> {{ $feedback->created_at->format('F j, Y h:i A') }}</p>

    <div class="alert alert-info">
        <strong>Rating Scale:</strong><br>
        1 - Very Dissatisfied &nbsp;
        2 - Dissatisfied &nbsp;
        3 - Neutral &nbsp;
        4 - Satisfied &nbsp;
        5 - Very Satisfied
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>5</th>
                    <th>4</th>
                    <th>3</th>
                    <th>2</th>
                    <th>1</th>
                </tr>
            </thead>
            <tbody>
                @php $count = 1; @endphp
                @foreach ($categories as $section => $fields)
                    <tr class="table-primary">
                        <td colspan="7"><strong>{{ $section }}</strong></td>
                    </tr>
                    @foreach ($fields as $field => $label)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $label }}</td>
                            @for ($i = 5; $i >= 1; $i--)
                                <td>
                                    <input
                                        type="radio"
                                        name="{{ $field }}"
                                        value="{{ $i }}"
                                        disabled
                                        {{ $feedback->$field == $i ? 'checked' : '' }}>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h5>Visitor Comments:</h5>
        <p class="border p-2 rounded bg-light">{{ $feedback->comments ?? 'No comments' }}</p>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
