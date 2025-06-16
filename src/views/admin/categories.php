<?php 
$pageTitle = 'Gestione Categorie';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('admin/header', ['pageTitle' => $pageTitle]);
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <a href="/admin/categories/new" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuova Categoria
            </a>
        </div>
    </div>
    
    <?php if (empty($categories)): ?>
        <div class="alert alert-info">
            Non ci sono categorie. Crea la tua prima categoria.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Articoli</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td><?= htmlspecialchars($category['name']) ?></td>
                            <td><span class="badge bg-info"><?= $category['article_count'] ?></span></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/admin/categories/edit/<?= $category['id'] ?>" class="btn btn-sm btn-primary" title="Modifica">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/category/<?= $category['id'] ?>" class="btn btn-sm btn-info" title="Visualizza" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Elimina" 
                                       onclick="if(confirm('Sei sicuro di voler eliminare questa categoria? Gli articoli associati rimarranno ma senza categoria.')) window.location.href='/admin/categories/delete/<?= $category['id'] ?>'">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php $template->include('admin/footer'); ?>
