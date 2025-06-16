<?php
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('admin/header', ['pageTitle' => $pageTitle]);
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <a href="/admin/articles" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Torna alla lista
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><?= $pageTitle ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= $article ? "/admin/articles/update/{$article['id']}" : "/admin/articles/create" ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $article ? htmlspecialchars($article['title']) : '' ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Seleziona categoria...</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= ($article && $article['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione breve</label>
                    <textarea class="form-control" id="description" name="description" rows="2" required><?= $article ? htmlspecialchars($article['description']) : '' ?></textarea>
                    <div class="form-text">Una breve descrizione dell'articolo (massimo 2-3 righe).</div>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Contenuto</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required><?= $article ? htmlspecialchars($article['content']) : '' ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                    <?php if ($article && $article['image']): ?>
                        <div class="mb-2">
                            <img src="<?= $article['image'] ?>" alt="Immagine attuale" class="img-thumbnail" style="max-height: 200px">
                            <p class="form-text">Immagine attuale. Carica una nuova immagine per sostituirla.</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salva
                </button>
            </form>
        </div>
    </div>
</div>

<?php $template->include('admin/footer'); ?>
