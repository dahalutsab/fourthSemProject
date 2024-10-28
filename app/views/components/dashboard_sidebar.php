<aside id="sidebar" class="sidebar">
    <?php
    $role = $_SESSION[SESSION_ROLE];
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard' ? 'active' : '' ?>" href="/dashboard">
                <i class="fa-solid fa-grip"></i>
                <span>Dashboard</span>
            </a>
        </li>

<!--        display if user is admin-->
        <?php if ($role === 'ADMIN') { ?>
            <li class="nav-item">
                <?php $isUserActive = in_array($currentPath, ['/dashboard/user/add', '/dashboard/user/manage']); ?>
                <a class="nav-link <?php echo $isUserActive ? '' : 'collapsed' ?>" data-bs-target="#user-nav" data-bs-toggle="collapse">
                    <i class="fa-solid fa-user"></i>
                    <span>Users</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav" class="nav-content collapse <?php echo $isUserActive ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-link <?php echo $currentPath === '/dashboard/user/add' ? 'active' : '' ?>" href="/dashboard/user/add">
                            <i class="fas fa-plus"></i><span>Add User</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo $currentPath === '/dashboard/user/manage' ? 'active' : '' ?>" href="/dashboard/user/manage">
                            <i class="fas fa-circle"></i><span>Manage Users</span>
                        </a>
                    </li>
                </ul>
        <?php } ?>


        <?php if ($role === 'ARTIST') { ?>
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
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/profile' ? 'active' : '' ?>" href="/dashboard/profile">
                <i class="fa-solid fa-user"></i>
                <span><?php echo ($_SESSION[SESSION_ROLE]); ?></span>
            </a>
        </li><!-- End Profile Nav -->


        <?php if ($role === 'ARTIST') { ?>
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
        <?php } ?>


        <?php if ($role === 'USER') { ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/user/booking' ? 'active' : '' ?>" href="/dashboard/user/booking">
                <i class="fa-solid fa-calendar"></i>
                <span>Booking</span>
            </a>
        </li><!-- End Booking Nav -->


        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/user/payment' ? 'active' : '' ?>" href="/dashboard/user/payment">
                <i class="fa-solid fa-money-bill"></i>
                <span>Payment</span>
            </a>
        </li><!-- End Payment Nav -->
        <?php } ?>

        <?php if ($role === 'ADMIN') { ?>


        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/contactUs' ? 'active' : '' ?>" href="/dashboard/contactUs">
                <i class="fa-solid fa-envelope"></i>
                <span>Contact Us</span>
            </a>
        </li><!-- End Contact Us Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/booking' ? 'active' : '' ?>" href="/dashboard/booking">
                <i class="fa-solid fa-calendar"></i>
                <span>Booking</span>
            </a>
        </li><!-- End Booking Nav -->
        <?php } ?>


        <?php if ($role === 'ARTIST') { ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/artist/booking' ? 'active' : '' ?>" href="/dashboard/artist/booking">
                <i class="fa-solid fa-calendar"></i>
                <span>Booking</span>
            </a>
        </li><!-- End Booking Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/artist/payment' ? 'active' : '' ?>" href="/dashboard/artist/payment">
                <i class="fa-solid fa-money-bill"></i>
                <span>Payment</span>
            </a>
        </li><!-- End Payment Nav -->
        <?php } ?>

<!--        messages-->
        <li class="nav-item">
            <a class="nav-link <?php echo $currentPath === '/dashboard/messages' ? 'active' : '' ?>" href="/dashboard/messages">
                <i class="fa-solid fa-envelope"></i>
                <span>Messages</span>
            </a>
        </li><!-- End Messages Nav -->




    </ul>
</aside>
