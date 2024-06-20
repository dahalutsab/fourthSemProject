<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="/"><i class="fa fa-close"></i> </a>
            </div>
            <h4 class="card-title mt-3 text-center">Forgot Password?</h4>
            <h6 class="text-center">Enter your email address</h6>

            <?php if (isset($_SESSION['forgot-password-error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['forgot-password-error']; ?>
                </div>
                <?php unset($_SESSION['forgot-password-error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION[SESSION_SUCCESS])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION[SESSION_SUCCESS]; ?>
                </div>
                <?php unset($_SESSION[SESSION_SUCCESS]); ?>
            <?php endif; ?>

            <form action="/forgot-password" method="post" id="forgot-password-form">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"> </i>
                        </span>
                        <input type="email" class="form-control" placeholder="Email address" name="email" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn" name="submit-forgot-password">Proceed</button>
                </div>
                <p class="text-center mb-0">
                    Remember your password? <a href="/login"><span style="color: var(--button-color)">Login</span></a>
                </p>
            </form>
        </div>
    </div>
</div>
