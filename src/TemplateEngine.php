<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

namespace SimpleCMS;

class TemplateEngine
{
    private static $instance = null;
    private $viewsPath;

    private function __construct()
    {
        $this->viewsPath = __DIR__ . '/views';
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }    public function render($view, $data = [])
    {
        $viewPath = $this->viewsPath . '/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View {$view} not found.");
        }
          // Carica la configurazione
        $config = require __DIR__ . '/config.php';
        $baseUrl = isset($config['base_url']) ? $config['base_url'] : '';
        
        // Normalizziamo il valore di base_url per evitare problemi con gli slash
        if ($baseUrl === '/') {
            $baseUrl = '';
        }
        
        // Aggiungi il base_url alle variabili disponibili nelle viste
        $data['base_url'] = $baseUrl;        // Estrai i dati come variabili
        extract($data);        // Inizia il buffer di output
        ob_start();
        
        // Includi le funzioni helper
        if (file_exists(__DIR__ . '/views/view_helpers.php')) {
            include_once __DIR__ . '/views/view_helpers.php';
        }
        
        // Includi il file di vista
        include $viewPath;
        
        // Cattura l'output e pulisci il buffer
        $content = ob_get_clean();
        
        return $content;
    }
      /**
     * Include un altro file di vista
     * 
     * @param string $view Nome della vista da includere
     * @param array $data Dati da passare alla vista
     */
    public function include($view, $data = [])
    {
        $viewPath = $this->viewsPath . '/' . $view . '.php';
        
        if (!file_exists($viewPath)) {
            throw new \Exception("View {$view} not found.");
        }
        
        // Carica la configurazione per il base_url
        $config = require __DIR__ . '/config.php';
        $baseUrl = isset($config['base_url']) ? $config['base_url'] : '';
        
        // Normalizziamo il valore di base_url per evitare problemi con gli slash
        if ($baseUrl === '/') {
            $baseUrl = '';
        }
        
        // Aggiungiamo il base_url ai dati
        $data['base_url'] = $baseUrl;        // Estrai i dati come variabili
        extract($data);
        
        // Includi le funzioni helper
        if (file_exists(__DIR__ . '/views/view_helpers.php')) {
            include_once __DIR__ . '/views/view_helpers.php';
        }
        
        // Include la vista
        include $viewPath;
    }
}