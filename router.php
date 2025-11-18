<?php
/**
 * Router moderne pour PHP built-in server
 * Gère les URLs propres et les convertit en actions pour index.php
 */

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Servir les fichiers statiques directement
if ($requestUri !== '/' && file_exists(__DIR__ . '/public' . $requestUri)) {
    return false;
}

if (preg_match('/\.(?:css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot)$/', $requestUri)) {
    if (file_exists(__DIR__ . '/public' . $requestUri)) {
        return false;
    }
}

// Charger la configuration des routes
$routes = require __DIR__ . '/config/routes.php';

// Variable pour suivre si une route a été trouvée
$routeFound = false;

// Essayer les routes simples d'abord
if (isset($routes[$requestUri])) {
    foreach ($routes[$requestUri] as $key => $value) {
        $_GET[$key] = $value;
    }
    $routeFound = true;
}

// Essayer les routes avec paramètres
if (!$routeFound) {
    foreach ($routes as $pattern => $params) {
        // Convertir le pattern en regex
        if (strpos($pattern, '{id}') !== false) {
            $regex = '#^' . str_replace('{id}', '(\d+)', preg_quote($pattern, '#')) . '$#';
            
            if (preg_match($regex, $requestUri, $matches)) {
                foreach ($params as $key => $value) {
                    $_GET[$key] = $value;
                }
                if (isset($matches[1])) {
                    $_GET['id'] = $matches[1];
                }
                $routeFound = true;
                break;
            }
        }
    }
}

// Si aucune route n'a été trouvée et que ce n'est pas la racine, marquer comme 404
if (!$routeFound && $requestUri !== '/' && !isset($_GET['action'])) {
    $_GET['action'] = 'error';
    $_GET['code'] = '404';
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
?>
