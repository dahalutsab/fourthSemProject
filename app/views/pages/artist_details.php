<div class="container">
    <!-- Breadcrumb and back link -->
    <div class="row bg-gradient shadow">
        <div class="col-lg-8 col-md-8">
            <div class="artist-landing">
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

    <!-- Artist's media and details -->
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="video-block shadow">
                <div id="carouselMedia" class="carousel img-block slide carousel-fade">
                    <div class="carousel-inner"></div>
                </div>
            </div>
            <div class="d-flex justify-content-around mt-2">
                <i class="fa-solid fa-arrow-left" data-bs-target="#carouselMedia" data-bs-slide="prev"></i>
                <i class="fa-solid fa-arrow-right" data-bs-target="#carouselMedia" data-bs-slide="next"></i>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="artist-aboutUs-content shadow">
                <div class="artist-img-block">
                    <img src="<?=BASE_IMAGE_PATH?>default-image.jpg" alt="image">
                </div>
                <div class="text-block">
                    <h2>Artist Name</h2>
                    <div class="Stars" style="--rating: 4.6;"></div>
                    <p>Artist description goes here.</p>
                </div>
                <div class="social-share">
                    <ul class="social-icon">
                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link"><i class="fa-brands fa-facebook"></i></a>
                        </li>
                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link"><i class="fa-brands fa-twitter"></i></a>
                        </li>
                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                        <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                            <a href="#" class="social-icon-link"><i class="fa-brands fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="hero-button">
                    <a href="#" class="cus-btn primary m-lg-2 m-md-1"><i class="fa fa-message"></i> Message</a>
                    <a href="#" class="cus-btn primary book-artist" id="open_book_modal"  data-bs-toggle="modal" data-bs-target="#bookArtistModal"><i class="fa fa-calendar-check"></i> Book</a>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="artist-overview text-center my-lg-5 my-md-2">
                <h3>Overview</h3>
                <p>Artist overview goes here.</p>
                <div class="d-flex justify-content-evenly">
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
                            <!-- Comments section will be dynamically populated -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for booking artist -->
<div class="modal fade" id="bookArtistModal" tabindex="-1" aria-labelledby="bookArtistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookArtistModalLabel">Book Artist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="artist_booking_performance_list">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Performance Type</th>
                        <th scope="col">Cost Per Hour</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Performance types will be dynamically populated -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?=BASE_JS_PATH?>view_artist_details.js"></script>
