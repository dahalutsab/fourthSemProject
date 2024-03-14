<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="/"><i class="fa fa-close"></i></a>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <h4 class="card-title mt-3 text-center">Enter OTP</h4>
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
    <script>
        // OTP input fields
        const inputs = document.querySelectorAll('.otp-input');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('input', function (event) {
                const currentInput = event.target;
                const currentValue = currentInput.value;

                // Clear the value if it's not a digit
                if (!/^\d$/.test(currentValue)) {
                    currentInput.value = '';
                    return;
                }

                // Move focus to the next input field if it exists
                if (i < inputs.length - 1 && currentValue !== '') {
                    inputs[i + 1].focus();
                }
            });

            // Move focus to the previous input field when backspace is pressed
            inputs[i].addEventListener('keydown', function (event) {
                if (event.key === 'Backspace' && i > 0 && !inputs[i].value) {
                    inputs[i - 1].focus();
                }
            });
        }
    </script>


</div>