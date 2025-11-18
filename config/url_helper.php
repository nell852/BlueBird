<?php
/**
 * Helper pour générer des URLs propres
 */

function url($route, $params = []) {
    $routes = require __DIR__ . '/routes.php';
    
    $reverseRoutes = [];
    foreach ($routes as $path => $route_params) {
        $key = $route_params['action'] . '.' . ($route_params['subaction'] ?? '');
        $reverseRoutes[$key] = $path;
    }
    
    if (isset($reverseRoutes[$route])) {
        $url = $reverseRoutes[$route];
        
        foreach ($params as $key => $value) {
            $url = str_replace('{' . $key . '}', $value, $url);
        }
        
        return $url;
    }
    
    return '/';
}

function redirect($route, $params = []) {
    header('Location: ' . url($route, $params));
    exit;
}
?>
