<section class="artists py-lg-5">
    <!--artists heading-->
    <div class="container">
        <div class="col-12 text-center">
            <h2 class="mb-4">Artists</h2>
        </div>
    </div>

    <!--artists nav-->
    <div class="container-fluid">
        <div class="row">
            <ul class="nav artist-nav-tabs" id="artistTab">
                <li class="nav-item">
                    <button class="nav-link active" id="singersTab" type="button">
                        Singers
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="poetrySlammersTab" type="button">
                        Poetry Slammers
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" id="standUpComediansTab" type="button">
                        StandUp Comedians
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="storyTellersTab" type="button">
                        Story Tellers
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!--artists cards-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="artist-content" id="artist-content">

                    <!--singers-->
                    <div class="tab-pane fade show active" id="artist-tab-pane">

                        <div class="row" id="card-design">
                            <?php
                            include 'artist_card.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>