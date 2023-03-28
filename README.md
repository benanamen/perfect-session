# Session Class

The` Session` class provides a simple and convenient way to manage PHP sessions.

## Usage

To use the `Session` class, create an instance of it and call its methods to get, set, or delete session data.


```php
use PerfectApp\Session\Session;

// Create a new session object
$session = new Session();

// Set a session variable
$session->set('username', 'johndoe');

// Get a session variable
$username = $session->get('username');

// Delete a session variable
$session->delete('username');
```

By default, the `Session` class uses the` $_SESSION` superglobal to store session data. You can also pass an array of session data to the constructor if you want to use a different session data source.

```php
// Create a session object using a custom session data array
$sessionData = [
    'username' => 'johndoe',
    'email' => 'johndoe@example.com',
];

$session = new Session($sessionData);

// Get a session variable
$username = $session->get('username');

// Delete a session variable
$session->delete('username');
```

## Methods
`__construct(array|null $sessionData = null)`

Creates a new `Session` object.

### Parameters

* `$sessionData` (optional): An array of session data to use instead of `$_SESSION`.

`get(string $key): mixed|null`

Gets a session variable by key.  

### Parameters

* `$key`: The name of the session variable to get.

### Returns

The value of the session variable, or `null` if the variable does not exist.

`set(string $key, mixed $value): void`

Sets a session variable by key.

### Parameters

* `$key`: The name of the session variable to set.
* `$value`: The value to assign to the session variable.

`delete(string $key): void`

Deletes a session variable by key.

### Parameters

* `$key`: The name of the session variable to delete.
