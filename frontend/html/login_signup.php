<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="../index.php?page="><i class="fa fa-close"></i> </a>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#login" role="tab" aria-selected="true">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#signup" role="tab" aria-selected="false">Sign Up</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="login">
                    <h4 class="card-title mt-3 text-center">Login</h4>
                    <form id="login-form">
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
                                <input type="password" class="form-control" placeholder="Create password" name="password" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="submit-btn" name="submit-login">Login</button>
                        </div>
                        <p class="text-center mb-0">
                            Don't have an account? Please <a href="#">Sign Up</a>
                        </p>
                    </form>
                </div>
                <div class="tab-pane" id="signup">
                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                    <form id="signup-form" action="../../backend/public/index.php" method="post">
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
                            Have an account? Please <a href="#">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>