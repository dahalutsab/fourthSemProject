
<div class="container-fluid sticky-top">
    <div class="navbar nav-style navbar-expand-lg pt-4">
        <a href="#" class="brand text-decoration-none d-block d-lg-none fw-bold fs-1 ">OMH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul id="nav-length" class="navbar-nav justify-content-between border-top border-2 text-center">

                <li class="nav-item nav-logo">
                    <a href="/" class="nav-link active border-hover py-3" id="home">
                        <img src="/public/assets/images/openMicLogo.png" class="logo" alt="Open Mic Hub">
                    </a>
                </li>

                <li class="nav-item dropdown position-static">
                    <a href="#" class="nav-link border-hover dropdown-toggle py-3" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Artists
                    </a>
                    <div class="dropdown-menu mt-0 w-100 nav-artists-dropdown" aria-labelledby="navbarDropdown">
                        <div class="border-outline-success shadow w-75 mx-auto nav-display nav-dropdown">
                            <ul class="d-flex justify-content-between">
                                <li>
                                    <a href="#singersTab">
                                        <img src="/public/assets/images/4.png" alt="singers">
                                        Singers
                                    </a>
                                </li>

                                <li>
                                    <a href="#poetrySlammersTab">
                                        <img src="/public/assets/images/2.png" alt="Poetry Slammers">
                                        Poetry Slammers
                                    </a>
                                </li>

                                <li>
                                    <a href="#standUpComediansTab">
                                        <img src="/public/assets/images/1.png" alt="Stand Up Comedians">
                                        Stand Up Comedians
                                    </a>
                                </li>

                                <li>
                                    <a href="#storyTellersTab">
                                        <img src="/public/assets/images/3.png" alt="Story Tellers">
                                        Story Tellers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="/services" class="nav-link border-hover py-3">Our Services</a>
                </li>


                <li class="nav-item search-width">
                    <form class="input-group py-2" >
                        <input type="search" class="form-control" id="search" placeholder="Search... ">
                        <button class="btn btn-outline-secondary search" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </li>

                <li class="nav-item">
                    <a href="#contact" class="nav-link border-hover py-3">Contact Us</a>
                </li>

                <li class="nav-item">
                    <?php if (isset($_SESSION[SESSION_USER_ID])): ?>
                        <!-- Display the "Logout" button if user is logged in -->
                        <a href="/logout" class="nav-link sign-button">
                            <i class="fa-solid fa-sign-out"></i>
                            Logout
                        </a>
                    <?php else: ?>
                        <!-- Display the "Sign In" button if user is not logged in -->
                        <a href="/login" class="nav-link my-2 sign-button">
                            <i class="fa-solid fa-sign-in"></i>
                            Sign In
                        </a>
                    <?php endif; ?>
                </li>

            </ul>
        </div>
    </div>
</div>