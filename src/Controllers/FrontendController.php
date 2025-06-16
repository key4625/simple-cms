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
}