<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors Log Monitoring System with Feedbacking - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="p-1">
        <a href="{{ route('visitor') }}">Visitor?</a>
    </div>
    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
        <!-- System Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">Visitors Log Monitoring System</h1>
            <h2 class="fw-bold">with Feedbacking</h2>
        </div>

        <!-- Login Form -->
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Username Field -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>




        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
