@extends('layouts.app')

@section('title', 'Provinces')

@section('content')
    <div class="container-fluid">
        <h1>Province Management</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success text-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Form Section (Left Side) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Province</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.province') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="province_name" class="form-label">Province Name</label>
                                <input type="text" class="form-control @error('province_name') is-invalid @enderror"
                                    id="province_name" name="province_name" value="{{ old('province_name') }}" required>
                                @error('province_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Province</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Table Section (Right Side) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Saved Provinces</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Province Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provinces as $province)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $province->province_name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm edit-btn"
                                                data-id="{{ $province->id }}" data-name="{{ $province->province_name }}"
                                                data-bs-toggle="modal" data-bs-target="#editProvinceModal">Edit</a>


                                            <form style="display:inline;">
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $province->id }}">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editProvinceModal" tabindex="-1" aria-labelledby="editProvinceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProvinceModalLabel">Edit Province</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editProvinceForm" method="POST" action="{{ route('province.update', $province->id ?? '') }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="edit_province_id" name="province_id">
                            <div class="mb-3">
                                <label for="edit_province_name" class="form-label">Province Name</label>
                                <input type="text" class="form-control" id="edit_province_name" name="province_name"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Delete Confirmation Modal -->
    <div class="modal fade border-danger" id="deleteConfirmationModal" tabindex="-1"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm border-danger">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>

                </div>
                <div class="modal-body">
                    Are you sure you want to delete this province?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript to Handle Modal Data -->
    <script>
        //behavior of modal
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const provinceId = this.getAttribute('data-id'); // Get the province ID
                    const provinceName = this.getAttribute('data-name'); // Get the province name

                    // Populate modal fields
                    document.getElementById('edit_province_id').value = provinceId; // Hidden input
                    document.getElementById('edit_province_name').value = provinceName; // Textbox

                    // Update the form action dynamically
                    const form = document.getElementById('editProvinceForm');
                    form.action =
                        `/provinces/${provinceId}`; // Update form action with the correct route
                });
            });
        });


        //delete

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            let selectedProvinceId = null;

            // Open modal when delete button is clicked
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedProvinceId = this.getAttribute('data-id'); // Get the province ID
                    const deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmationModal'));
                    deleteModal.show();
                });
            });

            // Handle delete confirmation
            confirmDeleteBtn.addEventListener('click', function() {
                if (selectedProvinceId) {
                    fetch(`/provinces/${selectedProvinceId}`, {
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
                                // Refresh the page after successful deletion
                                location.reload();
                            } else {
                                alert('Failed to delete the province.');
                            }
                        });
                }
            });
        });
    </script>

    </div>
@endsection
