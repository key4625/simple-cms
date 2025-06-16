<?php
$pageTitle = 'Informazioni sulla licenza';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="card-title">Licenza del software</h1>
                </div>
                <div class="card-body">
                    <h2>Creative Commons Attribution 4.0 International License</h2>
                    
                    <p>Questo progetto è rilasciato sotto la licenza <a href="http://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons Attribution 4.0 International</a>.</p>
                    
                    <h3>Con questa licenza sei libero di:</h3>
                    <ul>
                        <li><strong>Condividere</strong> — copiare e ridistribuire il materiale in qualsiasi mezzo o formato</li>
                        <li><strong>Modificare</strong> — remixare, trasformare il materiale e creare opere derivate da esso per qualsiasi fine, anche commerciale</li>
                    </ul>
                    
                    <h3>Alle seguenti condizioni:</h3>
                    <ul>
                        <li>
                            <strong>Attribuzione</strong> — Devi riconoscere una menzione di paternità adeguata, fornire un link alla licenza e indicare se sono state effettuate delle modifiche. 
                            Puoi fare ciò in qualsiasi maniera ragionevole possibile, ma non con modalità tali da suggerire che il licenziante avalli te o il tuo utilizzo del materiale.
                        </li>
                    </ul>
                    
                    <h3>Come dare attribuzione:</h3>
                    <p>Se utilizzi questo software, sei tenuto a dare credito all'autore originale. Un esempio di attribuzione potrebbe essere:</p>
                    
                    <div class="bg-light p-3 my-3">
                        <code>
                            Basato su Simple CMS, sviluppato da [Il tuo nome/organizzazione]
                        </code>
                    </div>
                    
                    <p>o semplicemente includere un link al repository originale.</p>
                    
                    <hr>
                    
                    <p>Per visualizzare una copia completa di questa licenza, visita: <a href="http://creativecommons.org/licenses/by/4.0/" target="_blank">creativecommons.org/licenses/by/4.0/</a></p>
                </div>
                <div class="card-footer text-center">
                    <p>© <?= date('Y') ?> Simple CMS</p>
                </div>
            </div>
            
            <div class="text-center mb-5">
                <a href="/" class="btn btn-primary">Torna alla home</a>
            </div>
        </div>
    </div>
</div>

<?php $template->include('frontend/footer'); ?>
