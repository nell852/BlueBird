<?php
/**
 * Router for PHP built-in server
 * Handles clean URLs by forwarding requests to index.php
 */

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($requestUri !== '/' && file_exists(__DIR__ . '/public' . $requestUri)) {
    return false;
}

if (preg_match('/\.(?:css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot)$/', $requestUri)) {
    if (file_exists(__DIR__ . '/public' . $requestUri)) {
        return false;
    }
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
?>
