<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link active" href="/dashboard">
                <i class="fa-solid fa-grip"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#media-nav" data-bs-toggle="collapse">
                <i class="fa-solid fa-photo-video"></i>
                <span>Media</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul id="media-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/dashboard/media/add">
                        <i class="fas fa-plus"></i><span>Add Media</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/media/manage">
                        <i class="fas fa-circle"></i><span>Manage Media</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Media Nav -->
        <li class="nav-item">
            <a class="nav-link" href="/dashboard/profile">
                <i class="fa-solid fa-user"></i>
                <span><?php echo ($_SESSION[SESSION_ROLE]);?></span>
            </a>
        </li><!-- End Profile Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#location-nav" data-bs-toggle="collapse">
                <i class="fa-solid fa-music"></i>
                <span>Performance</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul id="location-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/dashboard/performance/add">
                        <i class="fas fa-plus"></i><span>Add</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/performance/manage">
                        <i class="fas fa-circle"></i><span>Manage</span>
                    </a>
            </ul>
        </li>
    </ul>
</aside>

