
<section class="artists py-lg-5" id="artist">
    <div class="container">
        <div class="col-12 text-center">
            <h2 class="mb-4">Artists</h2>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <ul class="nav artist-nav-tabs" id="artistTab">
                <!-- Tabs will be populated dynamically -->
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="artist-content" id="artist-content">
                    <div class="tab-pane fade show active" id="artist-tab-pane">
                        <div class="row" id="card-design">
                            <!-- Artist cards will be appended here -->
                        </div>
                        <nav>
                            <ul class="pagination justify-content-center" id="pagination-controls">
                                <!-- Pagination controls will be appended here -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= BASE_JS_PATH ?>load_artist_cards.js"></script>

