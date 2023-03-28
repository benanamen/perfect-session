<?php

declare(strict_types=1);

namespace PerfectApp\Session;

use InvalidArgumentException;

/**
 * Class Session
 * @package PerfectApp\Session
 */
class Session implements SessionInterface
{
    /**
     * @var array|null
     */
    private ?array $sessionData;

    /**
     * Session constructor.
     * @param array|null $sessionData
     */
    public function __construct(?array $sessionData = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $var = $sessionData ?? $_SESSION;
        $this->sessionData = &$var;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key): mixed
    {
        return $this->sessionData[$key] ?? null;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, mixed $value): void
    {
        $this->sessionData[$key] = $value;
    }

    /**
     * @param string $key
     */
    public function delete(string $key): void
    {
        unset($this->sessionData[$key]);
    }
}
