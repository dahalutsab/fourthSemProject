<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="/"><i class="fa fa-close"></i> </a>
            </div>
            <h4 class="card-title mt-3 text-center">Forgot Password?</h4>
            <h2 class="text-center">Enter your email address</h2>
            <!-- Display error messages if any -->
                <div class="alert alert-danger">
                        <p></p>
                </div>

            <form  id="forgot-password-form">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <label>
                            <input type="email" class="form-control" placeholder="Email address" name="email" required>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn" name="submit-forgot-password">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>