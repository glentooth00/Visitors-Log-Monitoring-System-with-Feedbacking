@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Change Password</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h5>All Users</h5>
                <table class="table table-bordered table-hover table-striped text-center"
                    style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>

                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm change-password-btn" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-bs-toggle="modal"
                                        data-bs-target="#changePasswordModal">
                                        Change Password
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password for <span
                                id="modalUserName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST"
                        id="changePasswordForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <!-- Hidden input to store the user id -->
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalUserName = document.getElementById('modalUserName');
            const changePasswordForm = document.getElementById('changePasswordForm');

            document.querySelectorAll('.change-password-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.getAttribute('data-id');
                    const userName = button.getAttribute('data-name');

                    modalUserName.textContent = userName;
                    changePasswordForm.setAttribute('action', `/change-password/${userId}`);
                });
            });
        });
    </script>
@endsection
