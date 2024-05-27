<?php
declare(strict_types=1);

namespace App\Interceptor;

use JetBrains\PhpStorm\NoReturn;

class Interceptor
{
    private array $roleRestrictedPaths;
    private array $loginRequiredPaths;

    public function __construct(array $roleRestrictedPaths, array $loginRequiredPaths)
    {
        $this->roleRestrictedPaths = $roleRestrictedPaths;
        $this->loginRequiredPaths = $loginRequiredPaths;
    }

//    public function intercept(string $path, ?string $userRole): bool
//    {
//        if ($this->requiresLogin($path) && !$this->isUserAuthenticated()) {
//            $this->redirectTo('/login');
//            return false;
//        }
//
//        if ($this->isRestricted($path, $userRole)) {
//            $this->redirectTo('/access-denied');
//            return false;
//        }
//
//        return true;
//    }

    public function intercept(string $path, ?string $userRole): bool
    {
        if ($this->requiresLogin($path) && !$this->isUserAuthenticated()) {
            http_response_code(401); // Unauthorized
            $_SESSION['redirect_to'] = $path;
            header("Location: /login");
            exit;
        }

        if ($this->isRestricted($path, $userRole)) {
            http_response_code(403); // Forbidden
            return false;
//            header("Location: /access-denied");
//            exit;
        }

        return true;
    }



//    private function requiresLogin(string $path): bool
//    {
//        return in_array($path, $this->loginRequiredPaths);
//    }
    private function requiresLogin(string $path): bool
    {
        foreach ($this->loginRequiredPaths as $pattern) {
            if (preg_match('#^' . $pattern . '$#', $path)) {
                return true;
            }
        }
        return false;
    }

    private function isRestricted(string $path, ?string $userRole): bool
    {
        if (isset($this->roleRestrictedPaths[$path])) {
            return !in_array($userRole, $this->roleRestrictedPaths[$path]);
        }
        return false;
    }

    private function isUserAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    #[NoReturn] private function redirectTo(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}
