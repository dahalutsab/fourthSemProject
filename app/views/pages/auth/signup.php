<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <div class="alert alert-danger error-message" id="signup-error-messages" role="alert" style="display:none;">
                <ul id="error-list"></ul>
            </div>
            <form id="signup-form">
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
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <select class="form-select" id="roles-select" aria-label="Account type" name="role" required>
                            <option selected value="">Select account type</option>
                        </select>
                    </div>
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
                    Have an account? Please <a href="/login"><span style="color: var(--button-color)">Login</span></a>
                </p>
            </form>
        </div>
    </div>
</div>
<script src="<?= BASE_JS_PATH ?>signup.js"></script>