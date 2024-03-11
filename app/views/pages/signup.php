<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <form id="signup-form" action="/process-signup" method="post">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-user"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" placeholder="Email address" name="email" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <select class="form-select" aria-label="Account type" name="account_type" required>
                        <option selected value="">Select account type</option>
                        <option value="designer">User</option>
                        <option value="manager">Artist</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Create password" name="password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Repeat password" name="confirm_password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn" name="submit-signup">Create Account</button>
                </div>
                <p class="text-center mb-0">
                    Have an account? Please <a href="/login">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>