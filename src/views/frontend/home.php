<?php
$pageTitle = 'Home';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="container mt-4">
    <div class="row">
        <!-- Articoli principali -->
        <div class="col-lg-8">
            <h1 class="mb-4">Ultimi articoli</h1>
            
            <?php if (empty($articles)): ?>
                <div class="alert alert-info">
                    Non ci sono ancora articoli pubblicati.
                </div>
            <?php else: ?>
                <?php foreach ($articles as $article): ?>
                    <div class="card mb-4">
                        <div class="row g-0">
                            <?php if ($article['image']): ?>
                            <div class="col-md-4">
                                <img src="<?= $article['image'] ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($article['title']) ?>">
                            </div>
                            <?php endif; ?>
                            <div class="<?= $article['image'] ? 'col-md-8' : 'col-md-12' ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                                    
                                    <?php if (isset($article['category_name'])): ?>
                                        <span class="badge bg-secondary mb-2">
                                            <?= htmlspecialchars($article['category_name']) ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <p class="card-text"><?= htmlspecialchars($article['description']) ?></p>
                                    
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt"></i> 
                                            <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                                        </small>
                                    </p>
                                    
                                    <a href="/article/<?= $article['id'] ?>" class="btn btn-primary">Leggi articolo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Categorie</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php if (empty($categories)): ?>
                            <li class="list-group-item">Nessuna categoria</li>
                        <?php else: ?>
                            <?php foreach ($categories as $category): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="/category/<?= $category['id'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($category['name']) ?>
                                    </a>
                                    <?php 
                                    // Conta gli articoli in questa categoria
                                    $count = 0;
                                    foreach ($articles as $article) {
                                        if ($article['category_id'] == $category['id']) {
                                            $count++;
                                        }
                                    }
                                    ?>
                                    <span class="badge bg-primary rounded-pill"><?= $count ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5>Informazioni</h5>
                </div>
                <div class="card-body">
                    <p>Simple CMS è un content management system basico sviluppato con PHP, SQLite e Bootstrap.</p>
                    <p>Accedi all'area amministrativa per gestire i contenuti.</p>
                    <a href="/login" class="btn btn-outline-primary">
                        <i class="fas fa-user"></i> Area Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $template->include('frontend/footer'); ?>
