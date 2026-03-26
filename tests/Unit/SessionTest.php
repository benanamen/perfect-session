<?php

declare(strict_types=1);

namespace Unit;

use Codeception\Test\Unit;
use PerfectApp\Session\Session;

class SessionTest extends Unit
{
    private Session $session;

    protected function _before(): void
    {
        $this->session = new Session(['username' => 'johndoe']);
    }

    protected function _after(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = [];
    }

    public function testGet()
    {
        $this->assertEquals('johndoe', $this->session->get('username'));
        $this->assertNull($this->session->get('password'));
    }

    public function testSet()
    {
        $this->session->set('username', 'janedoe');
        $this->assertEquals('janedoe', $this->session->get('username'));
    }

    public function testDelete()
    {
        $this->session->delete('username');
        $this->assertNull($this->session->get('username'));
    }

    public function testHas()
    {
        $this->assertTrue($this->session->has('username'));
        $this->assertFalse($this->session->has('password'));
    }

    public function testClear()
    {
        $this->session->set('role', 'admin');
        $this->session->clear();
        $this->assertNull($this->session->get('username'));
        $this->assertNull($this->session->get('role'));
    }

    public function testStartWhenSessionIsAlreadyActive()
    {
        $this->session->start();
        $this->assertEquals('johndoe', $this->session->get('username'));
    }

    public function testLazyStartWhenAutoStartDisabled()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = [];

        $session = new Session(null, false);
        $session->set('tenant', 'north');
        $this->assertSame('north', $session->get('tenant'));
    }

    public function testRegenerateId()
    {
        $this->session->regenerateId();
        $this->assertTrue($this->session->has('username'));
    }

    public function testDestroyClearsSessionData()
    {
        $this->session->set('role', 'admin');
        $this->session->destroy();
        $this->assertSame(PHP_SESSION_NONE, session_status());
        $this->assertSame([], $_SESSION);
    }

    public function testDestroyNoOpWhenSessionInactive()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = [];

        $session = new Session(null, false);
        $session->destroy();
        $this->assertSame(PHP_SESSION_NONE, session_status());
    }

    public function testStartThrowsWhenNativeStartFails()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = [];

        $session = new class (null, false) extends Session {
            protected function startNativeSession(): bool
            {
                return false;
            }
        };

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to start session.');
        $session->start();
    }

    public function testRegenerateThrowsWhenNativeRegenerateFails()
    {
        $session = new class (null, false) extends Session {
            protected function regenerateNativeId(bool $deleteOldSession): bool
            {
                return false;
            }
        };

        $session->set('key', 'value');
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to regenerate session ID.');
        $session->regenerateId();
    }

    public function testDestroyThrowsWhenNativeDestroyFails()
    {
        $session = new class (null, false) extends Session {
            protected function destroyNativeSession(): bool
            {
                return false;
            }
        };

        $session->set('key', 'value');
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to destroy session.');
        $session->destroy();
    }
}
