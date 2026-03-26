<?php

declare(strict_types=1);

namespace PerfectApp\Session;

use RuntimeException;

/**
 * Class Session
 * @package PerfectApp\Session
 */
class Session implements SessionInterface
{
    public function __construct(?array $sessionData = null, bool $autoStart = true)
    {
        if ($autoStart) {
            $this->start();
        }

        if ($sessionData !== null) {
            $this->start();
            $_SESSION = $sessionData;
        }
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        if ($this->startNativeSession() === false) {
            throw new RuntimeException('Failed to start session.');
        }
    }

    public function get(string $key): mixed
    {
        $this->start();

        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $this->start();
        $_SESSION[$key] = $value;
    }

    public function delete(string $key): void
    {
        $this->start();
        unset($_SESSION[$key]);
    }

    public function has(string $key): bool
    {
        $this->start();

        return array_key_exists($key, $_SESSION);
    }

    public function clear(): void
    {
        $this->start();
        $_SESSION = [];
    }

    public function regenerateId(bool $deleteOldSession = true): void
    {
        $this->start();
        if ($this->regenerateNativeId($deleteOldSession) === false) {
            throw new RuntimeException('Failed to regenerate session ID.');
        }
    }

    public function destroy(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return;
        }

        $_SESSION = [];
        if ($this->destroyNativeSession() === false) {
            throw new RuntimeException('Failed to destroy session.');
        }
    }

    protected function startNativeSession(): bool
    {
        return session_start();
    }

    protected function regenerateNativeId(bool $deleteOldSession): bool
    {
        return session_regenerate_id($deleteOldSession);
    }

    protected function destroyNativeSession(): bool
    {
        return session_destroy();
    }
}
