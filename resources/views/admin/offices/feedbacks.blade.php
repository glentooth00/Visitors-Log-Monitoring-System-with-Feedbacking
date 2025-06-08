@extends('layouts.app')

@section('title', 'Feedbacks for ' . $office->office_name)

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Feedbacks for {{ $office->office_name }}</h2>

    @if ($feedbacks->isEmpty())
        <div class="alert alert-info">No feedbacks available for this office.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Visitor Name</th>
                            <th>Message</th>
                            <th>Submitted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $index => $feedback)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $feedback->visitor_name ?? 'Anonymous' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($feedback->remarks, 50) }}</td>
                                <td>{{ $feedback->created_at->format('F j, Y h:i A') }}</td>
                                <td>
                                <a href="{{ route('feedbacks.show', $feedback->id) }}" class="btn btn-primary btn-sm">
    View Feedback
</a>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>


@endsection

@push('scripts')
<script>
document.querySelectorAll('.view-feedback-btn').forEach(button => {
    button.addEventListener('click', () => {
        const name = button.getAttribute('data-name');
        const feedback = JSON.parse(button.getAttribute('data-feedback'));

        // Set visitor name in modal
        document.getElementById('visitorNameModal').innerText = name;
        document.getElementById('visitorName').innerText = name;

        // Clear all radios first
        document.querySelectorAll('#viewVisitorModal input[type=radio]').forEach(radio => {
            radio.checked = false;
        });

        // Loop feedback keys, skip comments
        for (const [key, value] of Object.entries(feedback)) {
            if (key === 'comments') continue;

            // Select radio with name=key and value=value
            const radio = document.querySelector(`#viewVisitorModal input[name="${key}"][value="${value}"]`);
            if (radio) {
                radio.checked = true;
            }
        }

        // Set comments text
        document.getElementById('commentsText').innerText = feedback.comments || 'No comments';

        // Show the modal (Bootstrap 5)
        const modal = new bootstrap.Modal(document.getElementById('viewVisitorModal'));
        modal.show();
    });
});
</script>
@endpush
