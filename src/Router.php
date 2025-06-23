<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

namespace SimpleCMS;

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }    private function matchRoute($uri, $route)
    {
        $routeParts = explode('/', trim($route, '/'));
        $uriParts = explode('/', trim($uri, '/'));
        
        if (count($routeParts) !== count($uriParts)) {
            return false;
        }
        
        $params = [];
        
        for ($i = 0; $i < count($routeParts); $i++) {
            // Se è un parametro dinamico (inizia con :)
            if (strpos($routeParts[$i], ':') === 0) {
                $paramName = substr($routeParts[$i], 1);
                $params[$paramName] = $uriParts[$i];
            } 
            // Altrimenti deve corrispondere esattamente
            elseif ($routeParts[$i] !== $uriParts[$i]) {
                return false;
            }
        }
        
        return $params;
    }    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Ottieni il base_url dalla configurazione
        $config = require __DIR__ . '/config.php';
        $baseUrl = isset($config['base_url']) ? $config['base_url'] : '';
        
        // Rimuovi il base_url dall'URI se presente
        if (!empty($baseUrl) && strpos($uri, $baseUrl) === 0) {
            $uri = substr($uri, strlen($baseUrl));
        }
        
        // Assicurati che l'URI inizi con / (anche se è vuoto dopo la rimozione del base_url)
        if (empty($uri)) {
            $uri = '/';
        }
        
        // Prima, prova a trovare una corrispondenza diretta
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            // Gestisci sia array che stringhe con formato controller@method
            if (is_array($action)) {
                [$controller, $method] = $action;
            } else {
                [$controller, $method] = explode('@', $action);
                $controller = "SimpleCMS\\Controllers\\$controller";
            }

            if (class_exists($controller) && method_exists($controller, $method)) {
                call_user_func([new $controller, $method]);
                return;
            }
        } 
        
        // Se non c'è corrispondenza diretta, cerca rotte con parametri dinamici
        foreach ($this->routes[$method] as $route => $action) {
            $params = $this->matchRoute($uri, $route);
            
            if ($params !== false) {
                // Gestisci sia array che stringhe con formato controller@method
                if (is_array($action)) {
                    [$controller, $method] = $action;
                } else {
                    [$controller, $method] = explode('@', $action);
                    $controller = "SimpleCMS\\Controllers\\$controller";
                }

                if (class_exists($controller) && method_exists($controller, $method)) {
                    call_user_func_array([new $controller, $method], $params);
                    return;
                }
            }
        }
        
        // Se arriviamo qui, non abbiamo trovato una corrispondenza
        http_response_code(404);
        echo 'Pagina non trovata';
    }
}