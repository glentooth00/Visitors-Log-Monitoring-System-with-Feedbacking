<!-- Sidebar Component -->
<nav id="sidebar" class="bg-dark">
    <div class="sidebar-header text-center py-3">
        <h4 class="text-white" id="sidebarTitle">Visitors Log Monitoring System</h4>
        <h5 class="text-white" id="sidebarSubtitle">with Feedbacking</h5>
        <hr>
    </div>
    <ul class="list-unstyled components">
        <li class="nav-item">
            <a class="nav-link active" href="#">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#" class="text-white menu-item">
                <i class="fas fa-users"></i> Visitors
            </a>
        </li>

        <!-- Settings Submenu -->
        <li>
            <a href="#settingsSubmenu" class="text-white dropdown-toggle main-item" data-bs-toggle="collapse" aria-expanded="false">
                <i class="fas fa-cogs"></i> Settings
            </a>
            <ul class="collapse list-unstyled submenu" id="settingsSubmenu">
                <li>
                    <a href="#" class="text-white submenu-item">
                        <i class="fas fa-plus-circle"></i> Add Course
                    </a>
                </li>
                <li>
                    <a href="#" class="text-white submenu-item">
                        <i class="fas fa-calendar-alt"></i> Yearly
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Main Content Section -->
<div id="content" class="container-fluid">
    <button type="button" id="sidebarToggle" class="btn btn-dark">
        <i class="fas fa-bars"></i> <!-- Hamburger Icon -->
    </button>
    <!-- The rest of your page content goes here -->
</div>

<!-- Custom Sidebar Styling -->
<style>
    /* Sidebar layout */
    #sidebar {
        min-width: 250px;
        max-width: 250px;
        height: 100vh;
        background-color: #343a40;
        color: #fff;
        position: fixed;
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

    /* Hide title and subtitle when collapsed */
    #sidebar.collapsed #sidebarTitle,
    #sidebar.collapsed #sidebarSubtitle {
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

    /* Hamburger Icon Styling */
    #sidebarToggle {
        margin-top: 20px;
        margin-left: 20px;
        background: none;
        border: none;
        color: #343a40;
    }

    #sidebarToggle i {
        font-size: 1.5rem;
    }

    /* Content section */
    #content {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
    }

    /* Adjust content area when sidebar is collapsed */
    #content.sidebar-collapsed {
        margin-left: 0;
    }
</style>

<!-- Include Bootstrap JS for Collapse Behavior -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> --}}

<script>
    // Toggle Sidebar Collapse
    $(document).ready(function () {
        $('#sidebarToggle').on('click', function () {
            $('#sidebar').toggleClass('collapsed'); // Toggle collapsed class on sidebar
            $('#content').toggleClass('sidebar-collapsed'); // Adjust content layout
        });
    });

    // document.querySelector('.main-item').addEventListener('click', function(event) {
    //     var submenu = document.getElementById('settingsSubmenu');
    //     var isExpanded = submenu.classList.contains('show');
    //     // Toggle 'collapse' and 'show' class
    //     if (isExpanded) {
    //         submenu.classList.remove('show');
    //     } else {
    //         submenu.classList.add('show');
    //     }
    //     // Update aria-expanded attribute
    //     event.currentTarget.setAttribute('aria-expanded', !isExpanded);
    // });
</script>
