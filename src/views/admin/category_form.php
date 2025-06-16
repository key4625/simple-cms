<?php
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('admin/header', ['pageTitle' => $pageTitle]);
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <a href="/admin/categories" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Torna alla lista
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><?= $pageTitle ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= $category ? "/admin/categories/update/{$category['id']}" : "/admin/categories/create" ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome categoria</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $category ? htmlspecialchars($category['name']) : '' ?>" required>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salva
                </button>
            </form>
        </div>
    </div>
</div>

<?php $template->include('admin/footer'); ?>
