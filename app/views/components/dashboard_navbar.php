<link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_navbar.css">

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/dashboard" class="logo d-flex align-items-center">
            <img src="<?=BASE_IMAGE_PATH?>openMicLogo.png" alt="">
            <span class="d-none d-lg-block">Open Mic Hub</span>
        </a>
<!--        <i class="fas fa-bars toggle-sidebar-btn" id="toggle-sidebar-btn"></i>-->
        <span class="toggle-sidebar-btn" id="toggle-sidebar-btn">
            <i class="fas fa-bars"></i>
        </span>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="fas fa-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="fas fa-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?=BASE_IMAGE_PATH?>default-profile.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">username</span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>username</h6>
                        <span>Role</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/dashboard/profile">
                            <i class="fas fa-user"></i>
                            <span class="ml-2">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
    if (toggleSidebarBtn) {
        toggleSidebarBtn.addEventListener('click', function(e) {
            console.log('clicked');
            document.body.classList.toggle('toggle-sidebar');
        });
    }

    fetch('/api/navbar/details')
        .then(response => response.json())
        .then(data => {
            // Check if the request was successful
            if (data.success) {
                // Get the profile link and dropdown menu
                var profileLink = document.querySelector('.nav-profile');
                var dropdownMenu = document.querySelector('.profile');

                // Update the profile image and username
                profileLink.querySelector('img').src = data.data.imagePath ? '/' + data.data.imagePath : '/assets/images/default-profile.png';                profileLink.querySelector('span').textContent = data.data.username;

                // Update the dropdown header
                var dropdownHeader = dropdownMenu.querySelector('.dropdown-header');
                dropdownHeader.querySelector('h6').textContent = data.data.username;
                dropdownHeader.querySelector('span').textContent = data.data.role;
            } else {
                console.error('Failed to fetch navbar details');
            }
        })
        .catch(error => console.error('Error:', error));
});

</script>
