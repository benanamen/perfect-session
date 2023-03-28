<?php

declare(strict_types=1);

namespace PerfectApp\Session;

interface SessionInterface
{
    public function get(string $key);
    public function set(string $key, $value);
    public function delete(string $key);
}
