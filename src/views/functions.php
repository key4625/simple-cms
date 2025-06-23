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
