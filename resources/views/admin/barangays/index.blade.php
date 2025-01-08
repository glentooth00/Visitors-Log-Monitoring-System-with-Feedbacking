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
                        <form method="POST" action="{{ route('store.barangay') }}">
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
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                data-id="{{ $barangay->id }}" data-name="{{ $barangay->barangay_name }}"
                                                data-province-id="{{ $barangay->municipality->province->id }}"
                                                data-municipality-id="{{ $barangay->municipality->id }}">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $barangay->id }}">
                                                Delete
                                            </button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals Section -->
    <!-- Edit Barangay Modal -->
    <div class="modal fade" id="editBarangayModal" tabindex="-1" aria-labelledby="editBarangayModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangayModalLabel">Edit Barangay</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <form id="editBarangayForm" method="POST" action="{{ route('barangays.update', $barangay->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">

                            <label for="edit_barangay_name" class="form-label">Barangay Name</label>
                            <input type="text" class="form-control" id="edit_barangay_name" name="barangay_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_province_id" class="form-label">Province</label>
                            <select class="form-control" id="edit_province_id" name="province_id" required>
                                <option value="" disabled selected hidden>Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_municipality_id" class="form-label">Municipality</label>
                            <select class="form-control" id="edit_municipality_id" name="municipality_id" required>
                                <option value="" disabled selected hidden>Select Municipality</option>
                                @foreach ($municipalities as $municipality)
                                    <option value="{{ $municipality->id }}">{{ $municipality->municipality_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Barangay Confirmation Modal -->
    <div class="modal fade" id="deleteBarangayModal" tabindex="-1" aria-labelledby="deleteBarangayModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBarangayModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this barangay?
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
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-btn');
        const editModal = new bootstrap.Modal(document.getElementById('editBarangayModal'));
        const editForm = document.getElementById('editBarangayForm');
        const barangayNameInput = document.getElementById('edit_barangay_name');
        const provinceSelect = document.getElementById('edit_province_id');
        const municipalitySelect = document.getElementById('edit_municipality_id');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const barangayId = button.dataset.id;
                const barangayName = button.dataset.name;
                const provinceId = button.dataset.provinceId;
                const municipalityId = button.dataset.municipalityId;

                // Populate modal fields
                barangayNameInput.value = barangayName;
                provinceSelect.value = provinceId;
                municipalitySelect.value = municipalityId;

                // Dynamically set the form's action URL
                editForm.action = `/barangays/${barangayId}`;

                // Show the modal
                editModal.show();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let selectedBarangayId = null;

        // Open modal when delete button is clicked
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                selectedBarangayId = this.getAttribute('data-id'); // Get barangay ID
                const deleteModal = new bootstrap.Modal(document.getElementById(
                    'deleteBarangayModal'));
                deleteModal.show();
            });
        });

        // Handle delete confirmation
        confirmDeleteBtn.addEventListener('click', function() {
            if (selectedBarangayId) {
                fetch(`/barangays/${selectedBarangayId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Close the modal after successful deletion
                            const deleteModal = new bootstrap.Modal(document.getElementById(
                                'deleteBarangayModal'));
                            deleteModal.hide();

                            // Refresh the page after successful deletion
                            location.reload();
                        } else {
                            alert('Failed to delete the barangay.');
                        }
                    })
                    .catch(error => alert('Error: ' + error));
            }
        });
    });
</script>
