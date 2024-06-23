<style>
    .section {
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .container {
        max-width: 90%;
        margin: auto;
    }

    .service-box {
        background-color: var(--card-color);
        color: var(--text-color);
        padding: 20px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .service-box:hover {
        transform: scale(1.05);
    }

    .service-box i {
        color: var(--button-color);
    }

    .service-box h5 {
        color: var(--text-color);
        margin-top: 20px;
    }

    .plan-line {
        height: 3px;
        width: 50px;
        background-color: var(--button-color);
        margin: 20px auto;
    }

</style>

<section class="section mb-5" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center">
                    <h2>Our Services</h2>
                    <hr class="my-3">
                    <p class=" mt-3 f-16">Explore the essential features that empower artists, venues, and enthusiasts in the OpenMicHub community.</p>
                    <div class="bottom-line bg-primary mx-auto"></div>
                </div>
            </div>
        </div>

        <div class="row mt-2 pt-2">
            <div class="col-lg-4">
                <div class="service-box text-center p-4">
                    <i class="mdi mdi-account-group display-3"></i>
                    <h5 class="fw-bold mt-2">Artist Discovery</h5>
                    <div class="plan-line mx-auto my-3"></div>
                    <p class=" f-16">Connect with local artists and discover new talents for collaborations and performances.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="service-box text-center p-4">
                    <i class="mdi mdi-calendar-clock display-3"></i>
                    <h5 class="fw-bold mt-2">Event Organization</h5>
                    <div class="plan-line mx-auto my-3"></div>
                    <p class=" f-16">Effortlessly manage and promote open mic events with detailed scheduling and attendee management.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="service-box text-center p-4">
                    <i class="mdi mdi-account-heart display-3"></i>
                    <h5 class="fw-bold mt-2">Community Interaction</h5>
                    <div class="plan-line mx-auto my-3"></div>
                    <p class=" f-16">Engage with a vibrant community of music lovers and performers through forums, reviews, and feedback.</p>
                </div>
            </div>
        </div>
    </div>
</section>
