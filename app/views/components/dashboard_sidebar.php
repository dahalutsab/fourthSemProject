<aside id="sidebar" class="sidebar">
    <?php
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard' ? 'active' : '' ?>" href="/dashboard">
                <i class="fa-solid fa-grip"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <?php $isMediaActive = in_array($currentPath, ['/dashboard/media/add', '/dashboard/media/manage']); ?>
            <a class="nav-link <?php echo $isMediaActive ? '' : 'collapsed' ?>" data-bs-target="#media-nav" data-bs-toggle="collapse">
                <i class="fa-solid fa-photo-video"></i>
                <span>Media</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul id="media-nav" class="nav-content collapse <?php echo $isMediaActive ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link <?php echo $currentPath === '/dashboard/media/add' ? 'active' : '' ?>" href="/dashboard/media/add">
                        <i class="fas fa-plus"></i><span>Add Media</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link <?php echo $currentPath === '/dashboard/media/manage' ? 'active' : '' ?>" href="/dashboard/media/manage">
                        <i class="fas fa-circle"></i><span>Manage Media</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Media Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/profile' ? 'active' : '' ?>" href="/dashboard/profile">
                <i class="fa-solid fa-user"></i>
                <span><?php echo ($_SESSION[SESSION_ROLE]); ?></span>
            </a>
        </li><!-- End Profile Nav -->

        <li class="nav-item">
            <?php $isPerformanceActive = in_array($currentPath, ['/dashboard/performance/add', '/dashboard/performance/manage']); ?>
            <a class="nav-link <?php echo $isPerformanceActive ? '' : 'collapsed' ?>" data-bs-target="#performance-nav" data-bs-toggle="collapse">
                <i class="fa-solid fa-music"></i>
                <span>Performance</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul id="performance-nav" class="nav-content collapse <?php echo $isPerformanceActive ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link <?php echo $currentPath === '/dashboard/performance/add' ? 'active' : '' ?>" href="/dashboard/performance/add">
                        <i class="fas fa-plus"></i><span>Add</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link <?php echo $currentPath === '/dashboard/performance/manage' ? 'active' : '' ?>" href="/dashboard/performance/manage">
                        <i class="fas fa-circle"></i><span>Manage</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Performance Nav -->
    </ul>
</aside>
