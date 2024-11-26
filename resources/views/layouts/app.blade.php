<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.header')
</head>
<body>
    <!-- Main Wrapper -->
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Page Content Wrapper -->
        <div id="content" class="p-4">
            <!-- Header -->
            <header>
                <!-- Include navigation or header elements here -->
            </header>

            <!-- Main Content -->
            <main>
                @yield('content') <!-- Page-specific content goes here -->
            </main>

            <!-- Footer -->
            <footer>
                <!-- Footer content if needed -->
            </footer>
        </div>
    </div>

    <!-- Additional Scripts -->
    @include('includes.footer')
    @yield('scripts') <!-- Page-specific scripts -->

    <!-- Sidebar CSS -->
    <style>
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #04396e;
            color: #fff;
            transition: all 0.3s;
        }

        #content {
            margin-left: 250px; /* Adjusts main content to be beside the sidebar */
            width: 100%;
            transition: all 0.3s;
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .components a {
            padding: 10px;
            font-size: 1rem;
            display: block;
            text-decoration: none;
            color: #fff;
        }

        .components a:hover, .components a:focus {
            background: #1074cb;
            color: #fff;
            text-decoration: none;
        }
    </style>


<!-- jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
