<?php
$pageTitle = $article['title'];
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php if (isset($article['category_name'])): ?>
                <li class="breadcrumb-item">
                    <a href="/category/<?= $article['category_id'] ?>"><?= htmlspecialchars($article['category_name']) ?></a>
                </li>
            <?php endif; ?>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($article['title']) ?></li>
        </ol>
    </nav>

    <article class="blog-post">
        <h1 class="blog-post-title mb-3"><?= htmlspecialchars($article['title']) ?></h1>
        
        <div class="article-metadata mb-4">
            <span class="text-muted">
                <i class="fas fa-calendar-alt"></i> 
                <?= date('d/m/Y', strtotime($article['created_at'])) ?>
            </span>
            
            <?php if (isset($article['category_name'])): ?>
                <span class="text-muted ms-3">
                    <i class="fas fa-folder"></i> 
                    <a href="/category/<?= $article['category_id'] ?>"><?= htmlspecialchars($article['category_name']) ?></a>
                </span>
            <?php endif; ?>
        </div>

        <?php if ($article['image']): ?>
            <div class="article-featured-image mb-4">
                <img src="<?= $article['image'] ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="img-fluid rounded">
            </div>
        <?php endif; ?>

        <div class="article-description lead mb-4">
            <?= htmlspecialchars($article['description']) ?>
        </div>
          <div class="article-content">
            <?= $article['content'] ?>
        </div>
    </article>
    
    <div class="mt-5 mb-5">
        <a href="/" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Torna alla lista degli articoli
        </a>
    </div>
    
    <?php if (!empty($relatedArticles)): ?>
        <div class="related-articles mt-5">
            <h3 class="mb-4">Articoli correlati</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($relatedArticles as $relatedArticle): ?>
                    <div class="col">
                        <div class="card h-100">
                            <?php if ($relatedArticle['image']): ?>
                                <img src="<?= $relatedArticle['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($relatedArticle['title']) ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($relatedArticle['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($relatedArticle['description'], 0, 100)) ?>...</p>
                                <a href="/article/<?= $relatedArticle['id'] ?>" class="btn btn-primary btn-sm">Leggi</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $template->include('frontend/footer'); ?>
