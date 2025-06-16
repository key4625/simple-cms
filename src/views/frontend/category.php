<?php
$pageTitle = 'Categoria: ' . $category['name'];
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($category['name']) ?></li>
        </ol>
    </nav>

    <div class="category-header mb-4">
        <h1 class="display-5"><?= htmlspecialchars($category['name']) ?></h1>
        <p class="lead">Articoli nella categoria "<?= htmlspecialchars($category['name']) ?>"</p>
    </div>

    <?php if (empty($articles)): ?>
        <div class="alert alert-info">
            Non ci sono articoli in questa categoria.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if ($article['image']): ?>
                            <img src="<?= $article['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($article['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                            <p class="card-text small text-muted">
                                <i class="fas fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                            </p>
                            <p class="card-text"><?= htmlspecialchars($article['description']) ?></p>
                            <a href="/article/<?= $article['id'] ?>" class="btn btn-primary">Leggi l'articolo</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php $template->include('frontend/footer'); ?>
