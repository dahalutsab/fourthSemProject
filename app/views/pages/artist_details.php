<div class="container">
    <div class="row bg-gradient shadow">
        <div class="col-lg-8 col-md-8">
            <div class = "artist-landing">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Homepage</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Singers</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 text-end">
            <a href="/#artist"><i class="fa-solid fa-backward"></i> Back to artists</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="video-block shadow">
                <div id="carouselVideoExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselVideoExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselVideoExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselVideoExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <video class="img-fluid" autoplay loop >
                                <source src="https://mdbcdn.b-cdn.net/img/video/Tropical.mp4" type="video/mp4" />
                            </video>
                        </div>

                        <div class="carousel-item">
                            <video class="img-fluid" autoplay loop >
                                <source src="https://mdbcdn.b-cdn.net/img/video/forest.mp4" type="video/mp4" />
                            </video>
                        </div>

                        <div class="carousel-item">
                            <video class="img-fluid" autoplay loop >
                                <source
                                    src="https://mdbcdn.b-cdn.net/img/video/Agua-natural.mp4"
                                    type="video/mp4"
                                />
                            </video>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselVideoExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselVideoExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="artist-aboutUs-content shadow">
                <div class="artist-img-block">
                    <img src="<?= BASE_IMAGE_PATH ?>utsab.jpg" alt="image">
                </div>
                <div class="text-block">
                    <h2>Apson Jirel</h2>
                    <!--reference: https://codepen.io/FredGenkin/pen/eaXYGV-->
                    <div class="Stars" style="--rating: 4.6;">
                    </div>
                    <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="social-share">
                    <ul class="social-icon">
                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>

                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>

                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>

                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="hero-button">
                    <a href="#" class="cus-btn primary m-lg-2 m-md-1"> <i class="fa fa-message"></i> Message</a>
                    <a href="#" class="cus-btn primary "> <i class="fa fa-calendar-check"></i> Book</a>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="artist-overview text-center my-lg-5 my-md-2">
                <h3>Overview</h3>
                <p>Some quick description text about artist.</p>
                <div class = "d-flex justify-content-evenly">
                    <div class="description-icons">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Location</p>
                    </div>
                    <div class="description-icons">
                        <i class="fa-solid fa-coins"></i>
                        <p>Cost</p>
                    </div>
                    <div class="description-icons">
                        <i class="fa-solid fa-phone"></i>
                        <p>Phone</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4 pb-2">Comments</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-start">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                             src="../../../public/assets/images/utsab.jpg" alt="avatar" width="65"
                                             height="65" />
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                        Utsab Dahal <span class="small">- 2 hours ago</span>
                                                    </p>
                                                    <a href="#"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a>
                                                </div>
                                                <p class="small mb-0">
                                                    He is a very good singer.
                                                </p>
                                            </div>

                                            <div class="d-flex flex-start mt-4">
                                                <a class="me-3" href="#">
                                                    <img class="rounded-circle shadow-1-strong"
                                                         src="../../../public/assets/images/utsab.jpg" alt="avatar"
                                                         width="65" height="65" />
                                                </a>
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-1">
                                                                Ramesh <span class="small">- 3 hours ago</span>
                                                            </p>
                                                        </div>
                                                        <p class="small mb-0">
                                                            A very good artist indeed.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-start mt-4">
                                                <a class="me-3" href="#">
                                                    <img class="rounded-circle shadow-1-strong"
                                                         src="../../../public/assets/images/utsab.jpg" alt="avatar"
                                                         width="65" height="65" />
                                                </a>
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-1">
                                                                Hari Gautam <span class="small">- 4 hours ago</span>
                                                            </p>
                                                        </div>
                                                        <p class="small mb-0">
                                                            nothing is going to happen.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>