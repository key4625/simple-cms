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

class BackendController
{
    private function checkLogin()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }

    public function login()
    {
        $template = TemplateEngine::getInstance();
        echo $template->render('login');
    }
    
    public function authenticate()
    {
        $db = Database::getInstance();

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Inizia la sessione e salva l'id utente
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect alla dashboard
            header('Location: /admin/dashboard');
            exit;
        } else {
            // Mostra un messaggio di errore
            $template = TemplateEngine::getInstance();
            echo $template->render('login', ['error' => 'Credenziali non valide']);
        }
    }
    
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
    
    public function dashboard()
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Conteggio articoli
        $stmtArticles = $db->query('SELECT COUNT(*) FROM articles');
        $articleCount = $stmtArticles->fetchColumn();
        
        // Conteggio categorie
        $stmtCategories = $db->query('SELECT COUNT(*) FROM categories');
        $categoryCount = $stmtCategories->fetchColumn();
        
        // Ultimi articoli
        $stmtLatest = $db->query('SELECT a.*, c.name as category_name 
                                FROM articles a
                                LEFT JOIN categories c ON a.category_id = c.id
                                ORDER BY a.created_at DESC LIMIT 5');
        $latestArticles = $stmtLatest->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('dashboard', [
            'username' => $_SESSION['username'],
            'articleCount' => $articleCount,
            'categoryCount' => $categoryCount,
            'latestArticles' => $latestArticles
        ]);
    }

    // CRUD per gli articoli
    public function articles()
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Tutti gli articoli
        $stmt = $db->query('SELECT a.*, c.name as category_name 
                          FROM articles a
                          LEFT JOIN categories c ON a.category_id = c.id
                          ORDER BY a.created_at DESC');
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('admin/articles', [
            'articles' => $articles
        ]);
    }
    
    public function newArticle()
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Categorie per il dropdown
        $stmt = $db->query('SELECT * FROM categories ORDER BY name');
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('admin/article_form', [
            'pageTitle' => 'Nuovo Articolo',
            'categories' => $categories,
            'article' => null
        ]);
    }
    
    public function createArticle()
    {
        $this->checkLogin();
        
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $content = $_POST['content'] ?? '';
        $category_id = $_POST['category_id'] ?? null;
        $image = '';
        
        // Gestione upload immagine
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = __DIR__ . '/../../uploads/';
            
            // Crea la directory se non esiste
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = '/uploads/' . $filename;
            }
        }
        
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO articles (title, description, content, image, category_id) 
                            VALUES (:title, :description, :content, :image, :category_id)');
                            
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'image' => $image,
            'category_id' => $category_id ?: null
        ]);
        
        header('Location: /admin/articles');
        exit;
    }
    
    public function editArticle($id)
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Recupera l'articolo
        $stmt = $db->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$article) {
            header('Location: /admin/articles');
            exit;
        }
        
        // Categorie per il dropdown
        $stmtCat = $db->query('SELECT * FROM categories ORDER BY name');
        $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('admin/article_form', [
            'pageTitle' => 'Modifica Articolo',
            'article' => $article,
            'categories' => $categories
        ]);
    }
    
    public function updateArticle($id)
    {
        $this->checkLogin();
        
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $content = $_POST['content'] ?? '';
        $category_id = $_POST['category_id'] ?? null;
        
        $db = Database::getInstance();
        
        // Recupera l'articolo esistente per l'immagine
        $stmtGet = $db->prepare('SELECT image FROM articles WHERE id = :id');
        $stmtGet->execute(['id' => $id]);
        $currentArticle = $stmtGet->fetch(PDO::FETCH_ASSOC);
        $image = $currentArticle['image'] ?? '';
        
        // Gestione upload nuova immagine
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = __DIR__ . '/../../uploads/';
            
            // Crea la directory se non esiste
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Cancella la vecchia immagine se esiste
                if ($image && file_exists(__DIR__ . '/../../' . $image)) {
                    unlink(__DIR__ . '/../../' . $image);
                }
                $image = '/uploads/' . $filename;
            }
        }
        
        $stmt = $db->prepare('UPDATE articles SET 
                            title = :title, 
                            description = :description, 
                            content = :content, 
                            image = :image,
                            category_id = :category_id
                            WHERE id = :id');
                            
        $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'image' => $image,
            'category_id' => $category_id ?: null
        ]);
        
        header('Location: /admin/articles');
        exit;
    }
    
    public function deleteArticle($id)
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Recupera l'immagine prima di cancellare l'articolo
        $stmt = $db->prepare('SELECT image FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Cancella l'articolo
        $stmtDelete = $db->prepare('DELETE FROM articles WHERE id = :id');
        $stmtDelete->execute(['id' => $id]);
        
        // Cancella l'immagine se esiste
        if ($article['image'] && file_exists(__DIR__ . '/../../' . $article['image'])) {
            unlink(__DIR__ . '/../../' . $article['image']);
        }
        
        header('Location: /admin/articles');
        exit;
    }
    
    // CRUD per le categorie
    public function categories()
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Tutte le categorie
        $stmt = $db->query('SELECT c.*, COUNT(a.id) as article_count 
                          FROM categories c
                          LEFT JOIN articles a ON c.id = a.category_id
                          GROUP BY c.id
                          ORDER BY c.name');
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $template = TemplateEngine::getInstance();
        echo $template->render('admin/categories', [
            'categories' => $categories
        ]);
    }
    
    public function newCategory()
    {
        $this->checkLogin();
        
        $template = TemplateEngine::getInstance();
        echo $template->render('admin/category_form', [
            'pageTitle' => 'Nuova Categoria',
            'category' => null
        ]);
    }
    
    public function createCategory()
    {
        $this->checkLogin();
        
        $name = $_POST['name'] ?? '';
        
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->execute(['name' => $name]);
        
        header('Location: /admin/categories');
        exit;
    }
    
    public function editCategory($id)
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Recupera la categoria
        $stmt = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$category) {
            header('Location: /admin/categories');
            exit;
        }
        
        $template = TemplateEngine::getInstance();
        echo $template->render('admin/category_form', [
            'pageTitle' => 'Modifica Categoria',
            'category' => $category
        ]);
    }
    
    public function updateCategory($id)
    {
        $this->checkLogin();
        
        $name = $_POST['name'] ?? '';
        
        $db = Database::getInstance();
        $stmt = $db->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'name' => $name
        ]);
        
        header('Location: /admin/categories');
        exit;
    }
    
    public function deleteCategory($id)
    {
        $this->checkLogin();
        
        $db = Database::getInstance();
        
        // Prima aggiorna gli articoli associati a questa categoria
        $stmt = $db->prepare('UPDATE articles SET category_id = NULL WHERE category_id = :id');
        $stmt->execute(['id' => $id]);
        
        // Poi cancella la categoria
        $stmtDelete = $db->prepare('DELETE FROM categories WHERE id = :id');
        $stmtDelete->execute(['id' => $id]);
        
        header('Location: /admin/categories');
        exit;
    }    public function uploadImage()
    {
        $this->checkLogin();
        
        // Verifica che ci sia un file caricato
        // CKEditor 5 usa 'upload' come nome del parametro
        $inputName = isset($_FILES['upload']) ? 'upload' : 'file';
        
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== 0) {
            header('Content-Type: application/json');
            echo json_encode([
                'uploaded' => false,
                'error' => [
                    'message' => 'Nessun file caricato o errore di upload'
                ]
            ]);
            exit;
        }
        
        $target_dir = __DIR__ . '/../../uploads/';
        
        // Crea la directory se non esiste
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $filename = time() . '_' . basename($_FILES[$inputName]['name']);
        $target_file = $target_dir . $filename;
        
        // Controlla il tipo di file (solo immagini)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = mime_content_type($_FILES[$inputName]['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            header('Content-Type: application/json');
            echo json_encode([
                'uploaded' => false,
                'error' => [
                    'message' => 'Tipo di file non supportato. Solo immagini consentite.'
                ]
            ]);
            exit;
        }
        
        // Carica il file
        if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $target_file)) {
            // Restituisce l'URL dell'immagine caricata
            $image_url = '/uploads/' . $filename;
            
            header('Content-Type: application/json');
            
            // Formato della risposta compatibile con CKEditor 5
            echo json_encode([
                'uploaded' => true,
                'url' => $image_url
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'uploaded' => false,
                'error' => [
                    'message' => 'Errore nel caricamento del file'
                ]
            ]);
            exit;
        }
    }
}