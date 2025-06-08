<!-- Sidebar Component -->
<nav id="sidebar" class="">
    <div class="sidebar-header text-center py-3">
        <h4 class="text-white" id="sidebarTitle">Visitors Management System</h4>
        <h5 class="text-white" id="sidebarSubtitle">with Feedbacking</h5>
        <hr>
    </div>
    <ul class="list-unstyled components ml-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('visitor.view') }}" class="text-white menu-item">
                <i class="fas fa-users"></i> Visitors
            </a>
        </li>
         <li>
            <a href="{{ route('feedback.view') }}" class="text-white menu-item">
                <i class="fas fa-users"></i> Feedbacks
            </a>
        </li>
         <li>
            <a href="#officeSubmenu" class="text-white dropdown-toggle main-item" data-bs-toggle="collapse"
                aria-expanded="false">
                <i class="fas fa-building"></i> Office
            </a>
            <ul class="collapse list-unstyled submenu pl-4" id="officeSubmenu">
                <li>

                    <a href="{{ route('office.index') }}" class="text-white submenu-item">
                        <i class="fas fa-list"></i> List of Offices
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings Submenu -->
        <li>
            <a href="#settingsSubmenu" class="text-white dropdown-toggle main-item" data-bs-toggle="collapse"
                aria-expanded="false">
                <i class="fas fa-cogs"></i> Settings
            </a>
            <ul class="collapse list-unstyled submenu pl-4" id="settingsSubmenu">
                <li>
                    <a href="{{ route('province') }}" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Add Province
                    </a>
                </li>
                <li>
                    <a href="{{ route('municipality') }}" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Add Municipality
                    </a>
                </li>
                <li>
                    <a href="{{ route('barangays') }}" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Add Barangay
                    </a>
                </li>
                <li>
                    <a href="#" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Add Street
                    </a>
                </li>
                <li>
                    <a href="{{ route('office') }}" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Add Office
                    </a>
                </li>
                <li>
                    <a href="{{ route('change_password') }}" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Change Password
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('feedbacks') }}" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Feedback items
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="#" class="text-white submenu-item">
                        <i class="fas fa-calendar-alt"></i> Yearly
                    </a>
                </li> --}}
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="text-white submenu-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>


            </ul>
        </li>
    </ul>
</nav>

<!-- Main Content Section -->
{{-- <div id="" class="">
    <button type="button" id="sidebarToggle" class="btn btn-dark">
        <i class="fas fa-bars"></i> <!-- Hamburger Icon -->
    </button>
    <!-- The rest of your page content goes here -->
</div> --}}

<!-- Custom Sidebar Styling -->
<style>
    /* Sidebar layout */
    #sidebar {
        /* min-width: 250px;
        max-width: 250px; */
        height: 100vh;
        background-color: #316294;
        color: #fff;
        transition: all 0.3s ease;
    }

    /* Sidebar collapsed state */
    #sidebar.collapsed {
        min-width: 0;
        max-width: 0;
        width: 0;
    }

    /* Hide the sidebar content when collapsed */
    #sidebar.collapsed .components {
        display: none;
    }


    /* Main Menu Items */
    .main-item {
        padding-left: 20px;
        font-size: 1rem;
        color: #fff;
    }

    /* Submenu Items */
    .submenu-item {
        padding-left: 40px;
        font-size: 0.9rem;
        color: #fff;
    }

    /* Hover Effects */
    .components a:hover {
        background-color: #6c757d;
        color: #fff;
    }
</style>

<!-- Include Bootstrap JS for Collapse Behavior -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> --}}

<script>
    // Toggle Sidebar Collapse
    $(document).ready(function() {
        $('#sidebarToggle').on('click', function() {
            $('#sidebar').toggleClass('collapsed'); // Toggle collapsed class on sidebar
            $('#content').toggleClass('sidebar-collapsed'); // Adjust content layout
        });
    });
</script>
