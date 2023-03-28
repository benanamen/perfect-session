[![codecov](https://codecov.io/gh/benanamen/perfect-session/branch/master/graph/badge.svg?token=50SIWrTfNG)](https://codecov.io/gh/benanamen/perfect-session)
[![CodeFactor](https://www.codefactor.io/repository/github/benanamen/perfect-session/badge)](https://www.codefactor.io/repository/github/benanamen/perfect-session)
[![codebeat badge](https://codebeat.co/badges/c7ee0d25-12b7-461b-87cf-4b997ed2b892)](https://codebeat.co/projects/github-com-benanamen-perfect-session-master)
[![Maintainability](https://api.codeclimate.com/v1/badges/149d089f8c3f7fb0a460/maintainability)](https://codeclimate.com/github/benanamen/perfect-session/maintainability)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/benanamen/perfect-session/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/benanamen/perfect-session/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/benanamen/perfect-session/badges/build.png?b=master)](https://scrutinizer-ci.com/g/benanamen/perfect-session/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/benanamen/perfect-session/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=bugs)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=sqale_index)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-session&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-session)

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
