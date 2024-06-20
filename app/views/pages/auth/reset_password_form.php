<?php

use app\repository\implementation\OtpRepository;
use app\service\implementation\EncryptDecryptService;

    if (!isset($_GET['data'])) {
         header('Location: /forgot-password');
     }
    else {
        $encryptedData = $_GET['data'];
        $encryptDecryptService = new EncryptDecryptService();
        $decryptedData = $encryptDecryptService->decryptData($encryptedData);
        if (!$decryptedData) {
            $_SESSION['forgot-password-error'] = "Invalid request. Please try again.";
            header('Location: /forgot-password');
            return;
        }
        $dataArray = json_decode($decryptedData, true);
        $userId = $dataArray['userId'];
        $otp = $dataArray['otp'];

        $otpService = new OtpRepository();
        try {
            $isValid = $otpService->verifyUserOtp($userId, $otp);
            if($_SESSION['otp-error']) {
                $_SESSION['forgot-password-error'] = $_SESSION['otp-error'];
                unset($_SESSION['otp-error']);
                header('Location: /forgot-password');
                return;
            }
        } catch (Exception $e) {
            $_SESSION['forgot-password-error'] = $e->getMessage();
            header('Location: /forgot-password');
            return;
        }

        if (!$isValid) {
            $_SESSION['forgot-password-error'] = "Invalid OTP. Please try again.";
            header('Location: /forgot-password');
            return;
        }
    }
?>


<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <div class="close-login position-absolute top-0 end-0 p-3">
                <a href="/"><i class="fa fa-close"></i> </a>
            </div>
            <h4 class="card-title mt-3 text-center">Change Password</h4>
            <!-- Display error messages if any -->
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

            <form id="reset-password-form" action="/reset-password" method="post">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <label for="confirm-password" class="sr-only">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn" name="submit-change-password">Change Password</button>
                </div>
                <p class="text-center mb-0">
                    Don't have an account? Please <a href="/signup"><span style="color: var(--button-color)">Sign Up</span></a>
                </p>
            </form>
        </div>
    </div>
</div>