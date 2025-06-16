<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

require_once __DIR__ . '/vendor/autoload.php';

use SimpleCMS\Database;

// Prima rimuoviamo eventuali vecchi file database
if (file_exists(__DIR__ . '/src/database.sqlite')) {
    unlink(__DIR__ . '/src/database.sqlite');
    echo "Database precedente rimosso.<br>";
}

// Inizializziamo un nuovo database
$db = Database::getInstance();
echo "Nuovo database creato.<br>";

// Verifichiamo che le tabelle siano state create correttamente
try {
    $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tabelle create: " . implode(", ", $tables) . "<br>";
    
    // Aggiungiamo un utente amministratore
    $username = 'admin';
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    
    $db->exec("INSERT INTO users (username, password) VALUES ('$username', '$password')");
    echo "Utente amministratore aggiunto con successo.<br>";
    
    // Aggiungiamo alcune categorie di esempio
    $db->exec("INSERT INTO categories (name) VALUES ('News')");
    $db->exec("INSERT INTO categories (name) VALUES ('Tutorial')");
    $db->exec("INSERT INTO categories (name) VALUES ('Tecnologia')");
    echo "Categorie di esempio aggiunte.<br>";
      // Aggiungiamo un articolo di esempio
    $title = 'Benvenuto nel tuo nuovo CMS';
    $description = 'Questo è il primo articolo del tuo Content Management System.';
    $content = "Benvenuto nel tuo nuovo CMS! Questo è un sistema di gestione contenuti semplice realizzato con PHP, SQLite e Bootstrap. Puoi utilizzare questo sistema per creare e gestire articoli organizzati in categorie. Accedi all'area amministrativa per iniziare a creare i tuoi contenuti.";
    
    $stmt = $db->prepare("INSERT INTO articles (title, description, content, category_id, created_at) 
                        VALUES (:title, :description, :content, 1, datetime('now'))");
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'content' => $content
    ]);
    echo "Articolo di esempio aggiunto.<br>";
    
    echo "<br>Inizializzazione del database completata con successo!";
    
} catch (Exception $e) {
    echo "Errore durante l'inizializzazione del database: " . $e->getMessage();
}
?>
