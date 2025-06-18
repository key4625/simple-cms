<?php 
$pageTitle = 'Dashboard';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('admin/header', ['pageTitle' => $pageTitle]);
?>

<div class="container-fluid">
    <!-- Pannelli riassuntivi -->
    <div class="row mb-4">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card card-dashboard bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75">Articoli totali</div>
                                    <div class="display-6 fw-bold"><?= $articleCount ?></div>
                                </div>
                                <i class="fas fa-file-alt fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card card-dashboard bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75">Categorie</div>
                                    <div class="display-6 fw-bold"><?= $categoryCount ?></div>
                                </div>
                                <i class="fas fa-folder fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    <!-- Tabella articoli recenti -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-file-alt me-1"></i> Articoli recenti</span>
            <a href="/admin/articles/new" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Nuovo articolo
            </a>
        </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titolo</th>
                                    <th>Categoria</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>                            <tbody>
                                <?php if (empty($latestArticles)): ?>
                                <tr>
                                    <td colspan="4" class="text-center">Nessun articolo disponibile</td>
                                </tr>
                                <?php else: ?>
                                    <?php foreach ($latestArticles as $article): ?>
                                    <tr>
                                        <td><?= $article['id'] ?></td>
                                        <td><?= htmlspecialchars($article['title']) ?></td>
                                        <td>
                                            <?php if ($article['category_name']): ?>
                                                <?= htmlspecialchars($article['category_name']) ?>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Nessuna categoria</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/admin/articles/edit/<?= $article['id'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/article/<?= $article['id'] ?>" class="btn btn-sm btn-info" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i> Attività recente
                </div>
                <div class="card-body">
                    <p>Non ci sono attività recenti da mostrare.</p>
                </div>            </div>
        </div>
    </div>
</div>

<?php $template->include('admin/footer'); ?>