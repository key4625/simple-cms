<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

/**
 * Ottieni il valore base_url per i template
 * 
 * @param string $path Percorso da aggiungere al base_url
 * @return string URL completo
 */
if (!function_exists('asset_url')) {
    function asset_url($path = '')
    {
        $config = require __DIR__ . '/../config.php';
        $baseUrl = isset($config['base_url']) ? $config['base_url'] : '';
        
        // Normalizziamo il valore
        if ($baseUrl === '/') {
            $baseUrl = '';
        }
        
        // Se il path inizia con / e baseUrl non è vuoto, evitiamo doppi slash
        if (!empty($path) && $path[0] === '/' && !empty($baseUrl)) {
            return $baseUrl . $path;
        }
        
        return $baseUrl . $path;
    }
}

/**
 * Funzione di supporto per i percorsi base nelle viste
 * Questa funzione è un fallback nel caso in cui $base_url non sia disponibile
 * 
 * @param string $path Il percorso da aggiungere al base_url
 * @return string Il percorso completo
 */
if (!function_exists('base_path')) {
    function base_path($path = '') 
    {
        global $base_url;
        
        // Se $base_url è definito come variabile globale, lo utilizziamo
        if (isset($base_url)) {
            if (!empty($path) && $path[0] === '/' && !empty($base_url)) {
                return $base_url . $path;
            }
            return $base_url . $path;
        } 
        // Altrimenti usiamo la funzione asset_url, se disponibile
        else if (function_exists('asset_url')) {
            return asset_url($path);
        }
        // Ultima risorsa: la funzione base_url
        else if (function_exists('base_url')) {
            return base_url($path);
        }
        
        // Fallback assoluto: leggiamo direttamente la configurazione
        $config = require __DIR__ . '/../config.php';
        $baseUrl = isset($config['base_url']) ? $config['base_url'] : '';
        
        // Normalizziamo
        if ($baseUrl === '/') {
            $baseUrl = '';
        }
        
        if (!empty($path) && $path[0] === '/' && !empty($baseUrl)) {
            return $baseUrl . $path;
        }
        
        return $baseUrl . $path;
    }
}
