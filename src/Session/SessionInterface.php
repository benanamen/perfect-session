<?php

declare(strict_types=1);

namespace PerfectApp\Session;

interface SessionInterface
{
    public function get(string $key): mixed;

    public function set(string $key, mixed $value): void;

    public function delete(string $key): void;
}
