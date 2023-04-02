<?php

declare(strict_types=1);

namespace Unit;

use Codeception\Test\Unit;
use PerfectApp\Session\Session;

class SessionTest extends Unit
{
    private Session $session;

    protected function _before()
    {
        $this->session = new Session(['username' => 'johndoe']);
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
}
