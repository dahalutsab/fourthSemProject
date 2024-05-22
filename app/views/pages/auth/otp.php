<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="/"><i class="fa fa-close"></i></a>
            </div>

            <h4 class="card-title mt-3 text-center">Enter OTP</h4>
            <div class="alert alert-danger error-message" id="error-messages" role="alert" style="display:none;">
                <ul id="error-list"></ul>
            </div>
            <form id="otp-form" method="post">
                <!-- OTP input fields -->
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control otp-input" maxlength="1" name="otp_1" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control otp-input" maxlength="1" name="otp_2" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control otp-input" maxlength="1" name="otp_3" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control otp-input" maxlength="1" name="otp_4" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control otp-input" maxlength="1" name="otp_5" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control otp-input" maxlength="1" name="otp_6" required>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn">Verify</button>
                </div>
                <p class="text-center mb-0">
                    Didn't receive an email? <a href="#">Send again</a>
                </p>
            </form>
        </div>
    </div>
    <script src="<?=BASE_JS_PATH?>otp.js"


</div>