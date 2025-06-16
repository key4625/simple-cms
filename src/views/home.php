<?php
// Impostazione del titolo della pagina
$pageTitle = 'Home';

// Includi l'header
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="row">
    <div class="col-md-8">
        <h1 class="pb-4 mb-4 border-bottom">
            Benvenuti su Simple CMS
        </h1>

        <article class="card mb-4 article-card">
            <div class="card-body">
                <h2 class="card-title">Esempio di articolo</h2>
                <div class="article-meta">Categoria: <span class="badge bg-secondary">Generale</span></div>
                <p class="card-text">Questo è un esempio di articolo che mostra come appariranno i contenuti pubblicati nel CMS. 
                Gli articoli saranno caricati dal database e mostrati qui con la formattazione appropriata.</p>
                <p class="card-text">Per aggiungere nuovi articoli, accedi all'area amministrativa.</p>
                <a href="#" class="btn btn-primary">Leggi di più</a>
            </div>
        </article>
        
        <article class="card mb-4 article-card">
            <div class="card-body">
                <h2 class="card-title">Un altro esempio di articolo</h2>
                <div class="article-meta">Categoria: <span class="badge bg-info">Tecnologia</span></div>
                <p class="card-text">Questo è un altro esempio di articolo nel nostro CMS. Gli articoli possono essere organizzati in categorie per una migliore navigazione.</p>
                <a href="#" class="btn btn-primary">Leggi di più</a>
            </div>
        </article>
    </div>
    
    <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
            <div class="card mb-4">
                <div class="card-header">Categorie</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-decoration-none">Generale</a></li>
                        <li><a href="#" class="text-decoration-none">Tecnologia</a></li>
                        <li><a href="#" class="text-decoration-none">Design</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Chi siamo</div>
                <div class="card-body">
                    <p class="card-text">Simple CMS è un sistema di gestione dei contenuti sviluppato per essere semplice ma potente.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Includi il footer
$template->include('frontend/footer');
?>