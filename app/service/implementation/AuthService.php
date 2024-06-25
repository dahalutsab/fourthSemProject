<?php
namespace app\service\implementation;

use app\repository\implementation\UserRepository;
use app\service\AuthServiceInterface;
use Exception;

require_once __DIR__ . '/../../repository/implementation/UserRepository.php';

class AuthService implements AuthServiceInterface {
    protected UserRepository $userRepository;
    protected OtpService $otpService;
    protected MailerService $mailerService;
    protected EncryptDecryptService $encryptDecryptService;

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->otpService = new OtpService;
        $this->mailerService = new MailerService;
        $this->encryptDecryptService = new EncryptDecryptService;
    }

    /**
     * @throws Exception
     */
    public function login($email, $password): void
    {
        $user = $this->userRepository->getUserByColumnValue('email', $email);
        if ($user==null) {
            throw new Exception("User doesnt exist");
        }

        if(!$user->getIsVerified()) {
            throw new Exception("Please verify your email to login.");
        }
        if(!$user->getIsActive()) {
            throw new Exception("User account doesnt exist. Please create a new account to continue.");
        }

        if ($user->getIsBlocked()) {
            throw new Exception("User account is blocked. Please contact support for assistance.");
        }
        $_SESSION[SESSION_USER_ID] = $user->getId();
        $_SESSION[SESSION_ROLE] = $user->getRole();
    }

    /**
     * @throws Exception
     */
    public function getUserRole(mixed $email)
    {
        return$this->userRepository->getUserRole($email);
    }


    /**
     * @throws Exception
     */
    public function forgotPassword(mixed $email): void
    {
        $user = $this->userRepository->getUserByColumnValue('email', $email);
        if ($user==null) {
            throw new Exception("User doesnt exist");
        }
        if(!$user->getIsActive()) {
            throw new Exception("User account doesnt exist. Please create a new account to continue.");
        }
        $otp = $this->otpService->generateOtp();
        $userId = $user->getId();
        $data = json_encode(['otp' => $otp, 'userId' => $userId]);
        $encryptedData = $this->encryptDecryptService->encryptData($data);

        $link = "http://localhost/reset-password?data=$encryptedData";
        if ($this->mailerService->sendCommonMail($email, $user->getUsername(), $link)) {
            $this->otpService->saveOtp($otp, $email);
        } else {
            throw new Exception("Failed to send email. Please try again.");
        }
    }

    public function resetPassword(mixed $password, mixed $data): void
    {
        $this->userRepository->resetPassword($password, $data);
    }


}
