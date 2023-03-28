<?php
declare(strict_types=1);

require_once './vendor/autoload.php';

use PerfectApp\Session\Session;

// Create a new session object
$session = new Session();

// Set a session variable
$session->set('username', 'johndoe');
dump($session);
// Get a session variable
$username = $session->get('username');
dump($username);

// Delete a session variable
$session->delete('username');
dump($session);
