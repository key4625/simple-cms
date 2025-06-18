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
                </div>                <div class="mb-3">
                    <label for="editor" class="form-label">Contenuto</label>
                    <div id="editor-container">
                        <div id="editor"><?= $article ? $article['content'] : '' ?></div>
                        <textarea class="form-control" id="content" name="content" style="display:none;"><?= $article ? $article['content'] : '' ?></textarea>
                    </div>
                </div>
                
                <!-- CKEditor 5 - gratuito, non richiede API key -->
                <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/balloon-block/ckeditor.js"></script>
                <style>
                    .ck-editor__editable {
                        min-height: 400px;
                    }
                    
                    /* Stile personalizzato per il bottone di inserimento immagini */
                    .image-upload-button {
                        display: inline-flex;
                        align-items: center;
                        cursor: pointer;
                        padding: 5px 10px;
                        background: #fff;
                        border: 1px solid #c1c1c1;
                        border-radius: 3px;
                        margin: 5px 0;
                    }
                    .image-upload-button:hover {
                        background: #f0f0f0;
                    }
                    #image-upload-input {
                        display: none;
                    }
                </style>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Aggiunge bottone per upload immagini sopra l'editor
                        const editorContainer = document.getElementById('editor-container');
                        const uploadButton = document.createElement('div');
                        uploadButton.className = 'image-upload-button';
                        uploadButton.innerHTML = '<svg width="20" height="20" viewBox="0 0 20 20"><path d="M6.91 10.54c.26-.23.64-.21.88.03l3.36 3.14 2.23-2.06a.64.64 0 0 1 .87 0l2.52 2.97V4.5H3.2v10.12l3.71-4.08zm10.27-7.51c.6 0 1.09.47 1.09 1.05v11.84c0 .59-.49 1.06-1.09 1.06H2.79c-.6 0-1.09-.47-1.09-1.06V4.08c0-.58.49-1.05 1.1-1.05h14.38zm-5.22 5.56a1.96 1.96 0 1 1 3.4-1.96 1.96 1.96 0 0 1-3.4 1.96z" fill="#000"></path></svg> Inserisci immagine';
                        
                        const fileInput = document.createElement('input');
                        fileInput.setAttribute('type', 'file');
                        fileInput.setAttribute('id', 'image-upload-input');
                        fileInput.setAttribute('accept', 'image/*');
                        
                        editorContainer.insertBefore(uploadButton, editorContainer.firstChild);
                        editorContainer.insertBefore(fileInput, editorContainer.firstChild);
                        
                        // Inizializza CKEditor con configurazione per balloon-block che supporta immagini
                        BalloonEditor
                            .create(document.querySelector('#editor'), {
                                toolbar: {
                                    items: [
                                        'undo', 'redo',
                                        '|', 'heading',
                                        '|', 'bold', 'italic',
                                        '|', 'link', 'uploadImage', 'insertTable', 'blockQuote',
                                        '|', 'bulletedList', 'numberedList'
                                    ]
                                },
                                image: {
                                    toolbar: [
                                        'imageTextAlternative', 'toggleImageCaption',
                                        '|', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'
                                    ]
                                },
                                // Configurazione per upload immagini
                                ckfinder: {
                                    uploadUrl: '/admin/upload-image'
                                }
                            })
                            .then(editor => {
                                // Quando il form viene inviato, aggiorna il textarea con il contenuto dell'editor
                                const form = document.querySelector('form');
                                const contentField = document.querySelector('#content');
                                
                                form.addEventListener('submit', function() {
                                    contentField.value = editor.getData();
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    });
                </script>
                
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
