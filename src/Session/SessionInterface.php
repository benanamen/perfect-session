<?php

declare(strict_types=1);

namespace PerfectApp\Session;

interface SessionInterface
{
    public function start(): void;

    public function get(string $key): mixed;

    public function set(string $key, mixed $value): void;

    public function delete(string $key): void;

    public function has(string $key): bool;

    public function clear(): void;

    public function regenerateId(bool $deleteOldSession = true): void;

    public function destroy(): void;
}
