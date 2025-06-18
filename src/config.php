<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

// Configurazione email
return [
    'email' => [
        'smtp_host' => 'smtp.example.com',
        'smtp_port' => 587,
        'smtp_secure' => 'tls',
        'smtp_auth' => true,
        'smtp_username' => 'username@example.com',
        'smtp_password' => 'password',
        'from_email' => 'noreply@example.com',
        'from_name' => 'Form Contatti Simple CMS',
        'to_email' => 'info@example.com',
        'to_name' => 'Admin Simple CMS',
    ]
];
