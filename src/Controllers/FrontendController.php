<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

namespace SimpleCMS\Controllers;

use SimpleCMS\Database;
use PDO;
use SimpleCMS\TemplateEngine;

class FrontendController
{    public function index()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT a.*, c.name as category_name 
                            FROM articles a
                            LEFT JOIN categories c ON a.category_id = c.id
                            ORDER BY a.created_at DESC');
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Categorie per la sidebar
        $stmtCat = $db->prepare('SELECT * FROM categories ORDER BY name');
        $stmtCat->execute();
        $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('frontend/home', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }
      public function article($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT a.*, c.name as category_name 
                            FROM articles a
                            LEFT JOIN categories c ON a.category_id = c.id
                            WHERE a.id = :id');
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$article) {
            // Articolo non trovato, reindirizza alla home
            header('Location: /');
            exit;
        }
        
        // Categorie per la sidebar
        $stmtCat = $db->prepare('SELECT * FROM categories ORDER BY name');
        $stmtCat->execute();
        $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
        
        // Articoli correlati (stessa categoria)
        $relatedArticles = [];
        if ($article['category_id']) {
            $stmtRelated = $db->prepare('SELECT * FROM articles 
                                      WHERE category_id = :category_id AND id != :article_id
                                      ORDER BY created_at DESC LIMIT 3');
            $stmtRelated->execute([
                'category_id' => $article['category_id'],
                'article_id' => $article['id']
            ]);
            $relatedArticles = $stmtRelated->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $template = TemplateEngine::getInstance();
        echo $template->render('frontend/article', [            'article' => $article,
            'categories' => $categories,
            'relatedArticles' => $relatedArticles
        ]);
    }
    
    public function category($id)
    {
        $db = Database::getInstance();
        
        // Recupera la categoria
        $stmtCat = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmtCat->execute(['id' => $id]);
        $category = $stmtCat->fetch(PDO::FETCH_ASSOC);
        
        if (!$category) {
            // Categoria non trovata, reindirizza alla home
            header('Location: /');
            exit;
        }
        
        // Recupera gli articoli della categoria
        $stmt = $db->prepare('SELECT a.*, c.name as category_name 
                            FROM articles a
                            LEFT JOIN categories c ON a.category_id = c.id
                            WHERE a.category_id = :category_id
                            ORDER BY a.created_at DESC');
        $stmt->execute(['category_id' => $id]);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Tutte le categorie per la sidebar
        $stmtAllCat = $db->prepare('SELECT * FROM categories ORDER BY name');
        $stmtAllCat->execute();
        $categories = $stmtAllCat->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('frontend/category', [
            'category' => $category,            'articles' => $articles,
            'categories' => $categories
        ]);
    }
    
    public function license()
    {
        $template = TemplateEngine::getInstance();
        echo $template->render('frontend/license');
    }

    public function chisono()
    {
        $template = TemplateEngine::getInstance();
        echo $template->render('frontend/chisono');
    }    public function contatti()
    {
        $template = TemplateEngine::getInstance();
        $message = '';
        $messageType = '';
        
        echo $template->render('frontend/contatti', [
            'message' => $message,
            'messageType' => $messageType
        ]);
    }
    
    public function inviaEmail()
    {
        // Validazione input
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $oggetto = filter_input(INPUT_POST, 'oggetto', FILTER_SANITIZE_SPECIAL_CHARS);
        $messaggio = filter_input(INPUT_POST, 'messaggio', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $errors = [];
        
        // Validazione campo nome
        if (empty($nome)) {
            $errors[] = 'Il nome è obbligatorio';
        }
        
        // Validazione email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email non valida';
        }
        
        // Validazione oggetto
        if (empty($oggetto)) {
            $errors[] = 'L\'oggetto è obbligatorio';
        }
        
        // Validazione messaggio
        if (empty($messaggio)) {
            $errors[] = 'Il messaggio è obbligatorio';
        }
        
        // Controllo anti-spam semplice (honeypot)
        if (!empty($_POST['website'])) {
            // Il campo nascosto è stato compilato, probabilmente è spam
            // Simuliamo l'invio senza inviare davvero
            $message = 'Il messaggio è stato inviato con successo!';
            $messageType = 'success';
            
            $template = TemplateEngine::getInstance();
            echo $template->render('frontend/contatti', [
                'message' => $message,
                'messageType' => $messageType
            ]);
            return;
        }
        
        if (empty($errors)) {
            try {
                // Inclusione di PHPMailer
                require_once __DIR__ . '/../../vendor/autoload.php';
                
                // Creazione di un'istanza di PHPMailer
                $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                  // Carica la configurazione email
                $config = require __DIR__ . '/../config.php';
                $emailConfig = $config['email'];
                
                // Configurazione server
                $mail->isSMTP();
                $mail->Host = $emailConfig['smtp_host'];
                $mail->SMTPAuth = $emailConfig['smtp_auth'];
                $mail->Username = $emailConfig['smtp_username'];
                $mail->Password = $emailConfig['smtp_password'];
                $mail->SMTPSecure = $emailConfig['smtp_secure'];
                $mail->Port = $emailConfig['smtp_port'];
                $mail->CharSet = 'UTF-8';
                
                // Destinatari
                $mail->setFrom($emailConfig['from_email'], $emailConfig['from_name']);
                $mail->addAddress($emailConfig['to_email'], $emailConfig['to_name']);
                $mail->addReplyTo($email, $nome);
                
                // Contenuto
                $mail->isHTML(true);
                $mail->Subject = '[Form Contatti] ' . $oggetto;
                $mail->Body = "
                    <h2>Nuovo messaggio dal form di contatto</h2>
                    <p><strong>Nome:</strong> $nome</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Oggetto:</strong> $oggetto</p>
                    <p><strong>Messaggio:</strong></p>
                    <p>" . nl2br($messaggio) . "</p>
                ";
                $mail->AltBody = "Nuovo messaggio dal form di contatto\n\n"
                    . "Nome: $nome\n"
                    . "Email: $email\n"
                    . "Oggetto: $oggetto\n"
                    . "Messaggio: $messaggio";
                
                // Invio email
                if ($mail->send()) {
                    $message = 'Il messaggio è stato inviato con successo!';
                    $messageType = 'success';
                } else {
                    $message = 'Si è verificato un errore durante l\'invio del messaggio.';
                    $messageType = 'danger';
                }
            } catch (\Exception $e) {
                $message = 'Si è verificato un errore: ' . $e->getMessage();
                $messageType = 'danger';
            }
        } else {
            $message = 'Si prega di correggere i seguenti errori: <ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
            $messageType = 'danger';
        }
        
        $template = TemplateEngine::getInstance();
        echo $template->render('frontend/contatti', [
            'message' => $message,
            'messageType' => $messageType,
            'nome' => $nome ?? '',
            'email' => $email ?? '',
            'oggetto' => $oggetto ?? '',
            'messaggio' => $messaggio ?? ''
        ]);
    }
}