<?php
/**
 * Funzione di supporto per i percorsi base nelle viste
 * Questa funzione è un fallback nel caso in cui $base_url non sia disponibile
 * 
 * @param string $path Il percorso da aggiungere al base_url
 * @return string Il percorso completo
 */
if (!function_exists('base_path')) {
    function base_path($path = '') {
    // Se $base_url è definito lo usiamo, altrimenti usiamo asset_url()
    global $base_url;
    
    if (isset($base_url)) {
        if (!empty($path) && $path[0] === '/' && !empty($base_url)) {
            return $base_url . $path;
        }
        return $base_url . $path;
    } else if (function_exists('asset_url')) {
        return asset_url($path);
    } else if (function_exists('base_url')) {
        return base_url($path);
    }
    
    // Fallback assoluto
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
?>
