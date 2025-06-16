<?php 
$pageTitle = 'Gestione Articoli';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('admin/header', ['pageTitle' => $pageTitle]);
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <a href="/admin/articles/new" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuovo Articolo
            </a>
        </div>
    </div>
    
    <?php if (empty($articles)): ?>
        <div class="alert alert-info">
            Non ci sono articoli. Crea il tuo primo articolo.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Immagine</th>
                        <th>Titolo</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?= $article['id'] ?></td>
                            <td>
                                <?php if ($article['image']): ?>
                                    <img src="<?= $article['image'] ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="img-thumbnail" style="max-height: 50px">
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nessuna immagine</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($article['title']) ?></td>
                            <td>
                                <?php if ($article['category_name']): ?>
                                    <?= htmlspecialchars($article['category_name']) ?>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nessuna categoria</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/admin/articles/edit/<?= $article['id'] ?>" class="btn btn-sm btn-primary" title="Modifica">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/view/article/<?= $article['id'] ?>" class="btn btn-sm btn-info" title="Visualizza" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Elimina" 
                                       onclick="if(confirm('Sei sicuro di voler eliminare questo articolo?')) window.location.href='/admin/articles/delete/<?= $article['id'] ?>'">
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
