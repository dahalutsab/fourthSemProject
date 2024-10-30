<?php
namespace config;

class DatabaseConfig {
    private string $host;
    private string $username;
    private string $password;
    private string $database;
    private string $sslMode;
    private string $sslCert;
    private string $caCert;

    public function __construct() {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->username = getenv('DB_USERNAME') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
        $this->database = getenv('DB_DATABASE') ?: 'open_mic_hub';
        $this->sslMode = getenv('DB_SSL_MODE') ?: 'DISABLED';
        $this->sslCert = getenv('DB_SSL_CERT') ?: '';
        $this->caCert = '/etc/ssl/certs/ca.pem';
    }

    public function getHost(): string {
        return $this->host;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getDatabase(): string {
        return $this->database;
    }

    public function getSslMode(): string {
        return $this->sslMode;
    }

    public function getSslCert(): string {
        return $this->sslCert;
    }

    public function getCaCert(): string {
        return $this->caCert;
    }
}