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
                                <input type="text" class="form-control @error('municipality_name') is-invalid @enderror"
                                    id="municipality_name" name="municipality_name" value="{{ old('municipality_name') }}"
                                    required>
                                @error('municipality_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="province_id" class="form-label">Province</label>
                                <select class="form-select form-control" id="province_id" name="province_id" required>
                                    <option value="" hidden>Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}"
                                            {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                            {{ $province->province_name }}
                                        </option>
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
                                        <td>{{ $loop->iteration + ($municipalities->currentPage() - 1) * $municipalities->perPage() }}
                                        </td>
                                        <td>{{ $municipality->municipality_name }}</td>
                                        <td>{{ $municipality->province->province_name }}</td>
                                        <td>
                                            <!-- Edit Button with data attributes -->
                                            <button class="btn btn-primary btn-sm edit-btn"
                                                data-id="{{ $municipality->id }}"
                                                data-name="{{ $municipality->municipality_name }}"
                                                data-province-id="{{ $municipality->province_id }}"
                                                data-province-name="{{ $municipality->province->province_name }}"
                                                data-bs-toggle="modal" data-bs-target="#editMunicipalityModal">
                                                Edit
                                            </button>

                                            <!-- Delete Button with data-id -->
                                            <button class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $municipality->id }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmationModal">
                                                Delete
                                            </button>
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
                                {{ $municipalities->links() }}
                            </div>
                            <div class="d-flex align-items-center">
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

    <!-- Edit Municipality Modal -->
    <div class="modal fade" id="editMunicipalityModal" tabindex="-1" aria-labelledby="editMunicipalityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editMunicipalityForm" method="POST"
                action="{{ route('municipalities.update', $municipality->id ?? '') }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMunicipalityModalLabel">Edit Municipality</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_municipality_id" name="municipality_id">
                        <div class="mb-3">
                            <label for="edit_municipality_name" class="form-label">Municipality Name</label>
                            <input type="text" class="form-control" id="edit_municipality_name" name="municipality_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_province_id" class="form-label">Province</label>
                            <select class="form-select form-control" id="edit_province_id" name="province_id" required>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" id="edit_province_name">
                                        {{ $province->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this municipality? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    // Behavior of Edit Modal
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const municipalityId = this.getAttribute('data-id'); // Get the municipality ID
                const municipalityName = this.getAttribute(
                    'data-name'); // Get the municipality name
                const provinceId = this.getAttribute('data-province-id'); // Get the province ID
                const provinceName = this.getAttribute(
                    'data-province-name'); // Get the province name

                // Populate modal fields
                document.getElementById('edit_municipality_id').value =
                    municipalityId; // Hidden input
                document.getElementById('edit_municipality_name').value =
                    municipalityName; // Municipality name textbox
                document.getElementById('edit_province_id').value =
                    provinceId; // Province select field
                document.getElementById('edit_province_name').value =
                    provinceName; // Hidden province name field

                // Update the form action dynamically for municipality edit
                const form = document.getElementById('editMunicipalityForm');
                form.action =
                    `/municipalities/${municipalityId}`; // Update form action with the correct route
            });
        });
    });

    // Behavior of Delete Modal
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let selectedMunicipalityId = null;

        // Open modal when delete button is clicked
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                selectedMunicipalityId = this.getAttribute(
                    'data-id'); // Get the municipality ID
                const deleteModal = new bootstrap.Modal(document.getElementById(
                    'deleteConfirmationModal'));
                deleteModal.show();
            });
        });

        // Handle delete confirmation
        confirmDeleteBtn.addEventListener('click', function() {
            if (selectedMunicipalityId) {
                fetch(`/municipalities/${selectedMunicipalityId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Log the response for debugging
                        if (data.success) {
                            // Refresh the page after successful deletion
                            location.reload(true); // Force a reload without cache
                        } else {
                            alert('Failed to delete the municipality.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the municipality.');
                    });
            }
        });

    });
</script>
