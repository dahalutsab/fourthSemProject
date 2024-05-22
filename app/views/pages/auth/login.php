<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="/"><i class="fa fa-close"></i> </a>
            </div>
            <h4 class="card-title mt-3 text-center">Login</h4>
            <!-- Display error messages if any -->
            <?php if (isset($_SESSION[SESSION_ERRORS])): ?>
                <div class="alert alert-danger">
                    <?php foreach ($_SESSION[SESSION_ERRORS] as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION[SESSION_ERRORS]); ?>
            <?php endif; ?>

            <form id="login-form" action="/login" method="post">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" placeholder="Email address" name="email" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Input password" name="password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn" name="submit-login">Login</button>
                </div>
                <p class="text-center mb-0">
                    Don't have an account? Please <a href="/signup">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</div>