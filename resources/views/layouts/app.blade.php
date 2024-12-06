<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.header')
</head>

<body>
    <!-- Main Wrapper with Flexbox -->
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Page Content Wrapper with Flex Grow for dynamic width -->
        <div id="content" class="flex-grow-1 p-4" style="min-height: 100vh; margin-left: 250px;">
            <!-- Adjusted margin-left -->
            <!-- Main Content -->
            <main>
                @yield('content') <!-- Page-specific content goes here -->
            </main>
        </div>
    </div>

    <!-- Additional Scripts -->
    @include('includes.footer')
    @yield('scripts') <!-- Page-specific scripts -->

    <!-- Sidebar CSS -->
    <style>
        /* Sidebar Styles */
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
            overflow-y: auto;
        }

        #content {
            margin-left: 250px;
            /* Push content to the right side */
            transition: all 0.3s;
            width: 100%;
        }

        /* When sidebar is collapsed */
        #sidebar.collapsed {
            margin-left: -250px;
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

        .components a:hover,
        .components a:focus {
            background: #1074cb;
            color: #fff;
            text-decoration: none;
        }

        /* Ensure content is left-aligned */
        #content main {
            text-align: left;
            /* Ensures the content is aligned to the left */
        }
    </style>

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Sidebar toggle for mobile view
        $(document).ready(function() {
            $('.burger-menu').click(function() {
                $('#sidebar').toggleClass('collapsed');
            });
        });
    </script>
</body>

</html>
