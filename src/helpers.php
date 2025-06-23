<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

// Rimozione del namespace per rendere queste funzioni accessibili globalmente

/**
 * Ottiene il valore di base_url dalle configurazioni
 *
 * @param string $path Il percorso da aggiungere al base_url (deve iniziare con /)
 * @return string L'URL completo con il percorso base
 */
function base_url($path = '')
{
    static $config = null;
    
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }
    
    $baseUrl = isset($config['base_url']) ? $config['base_url'] : '';
    
    // Se il path inizia con / e baseUrl non è vuoto, evitiamo doppi slash
    if (!empty($path) && $path[0] === '/' && !empty($baseUrl)) {
        return $baseUrl . $path;
    }
    
    return $baseUrl . $path;
}

/**
 * Crea un URL assoluto con il percorso base
 *
 * @param string $path Il percorso da aggiungere
 * @return string L'URL completo
 */
function url($path = '')
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    
    return $protocol . '://' . $host . base_url($path);
}

/**
 * Reindirizza a un URL specifico
 *
 * @param string $path Il percorso a cui reindirizzare
 * @return void
 */
function redirect($path)
{
    header('Location: ' . base_url($path));
    exit;
}
