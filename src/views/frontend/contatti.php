<?php
$pageTitle = 'Contatti';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="container mt-5">
    <!-- Header con breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contatti</li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-8 mb-5">
            <h1 class="display-4 mb-4">Contattami</h1>
            
            <?php if (!empty($message)): ?>
                <div class="alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
                    <?= $message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="/invia-email" method="post" id="contactForm">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome*</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($nome) ? htmlspecialchars($nome) : '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="oggetto" class="form-label">Oggetto*</label>
                            <input type="text" class="form-control" id="oggetto" name="oggetto" value="<?= isset($oggetto) ? htmlspecialchars($oggetto) : '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="messaggio" class="form-label">Messaggio*</label>
                            <textarea class="form-control" id="messaggio" name="messaggio" rows="6" required><?= isset($messaggio) ? htmlspecialchars($messaggio) : '' ?></textarea>
                        </div>
                        
                        <!-- Campo anti-spam honeypot (invisibile per gli utenti umani) -->
                        <div class="d-none">
                            <label for="website">Website (lascia vuoto questo campo)</label>
                            <input type="text" name="website" id="website" autocomplete="off">
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                            <label class="form-check-label" for="privacy">Acconsento al trattamento dei miei dati personali ai sensi del Regolamento UE 679/2016 (GDPR)*</label>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Invia messaggio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-map-marker-alt text-primary me-2"></i> Indirizzo</h3>
                    <p class="card-text">
                        Via Roma, 123<br>
                        20100 Milano (MI)<br>
                        Italia
                    </p>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-phone text-primary me-2"></i> Telefono</h3>
                    <p class="card-text">
                        <a href="tel:+390123456789" class="text-decoration-none">+39 012 3456789</a>
                    </p>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-envelope text-primary me-2"></i> Email</h3>
                    <p class="card-text">
                        <a href="mailto:info@example.com" class="text-decoration-none">info@example.com</a>
                    </p>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-clock text-primary me-2"></i> Orari</h3>
                    <p class="card-text mb-1"><strong>Lunedì - Venerdì:</strong> 9:00 - 18:00</p>
                    <p class="card-text mb-1"><strong>Sabato:</strong> 9:00 - 12:00</p>
                    <p class="card-text"><strong>Domenica:</strong> Chiuso</p>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-share-alt text-primary me-2"></i> Social</h3>
                    <div class="d-flex justify-content-around">
                        <a href="#" class="text-decoration-none" title="Facebook">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="#" class="text-decoration-none" title="Twitter">
                            <i class="fab fa-twitter fa-2x"></i>
                        </a>
                        <a href="#" class="text-decoration-none" title="LinkedIn">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                        <a href="#" class="text-decoration-none" title="Instagram">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mappa (opzionale) -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="ratio ratio-21x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2798.854087057741!2d9.18976761525928!3d45.46475637910091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c6aec34636a1%3A0xab7f4e27101a2e08!2sPiazza%20del%20Duomo%2C%20Milano%20MI!5e0!3m2!1sit!2sit!4v1623912345678!5m2!1sit!2sit" 
                                style="border:0;" allowfullscreen="" loading="lazy" title="Mappa della nostra sede"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pulsante torna alla home -->
    <div class="text-center mb-5">
        <a href="/" class="btn btn-primary">
            <i class="fas fa-arrow-left me-2"></i>Torna alla home
        </a>
    </div>
</div>

<!-- Script di validazione client-side -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    
    if (form) {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const oggetto = document.getElementById('oggetto').value.trim();
            const messaggio = document.getElementById('messaggio').value.trim();
            const privacy = document.getElementById('privacy').checked;
            
            // Verifica che i campi obbligatori siano compilati
            if (!nome || !email || !oggetto || !messaggio || !privacy) {
                isValid = false;
                alert('Per favore compila tutti i campi obbligatori.');
            }
            
            // Verifica che l'email sia valida
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                isValid = false;
                alert('Per favore inserisci un indirizzo email valido.');
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
    }
});
</script>

<?php $template->include('frontend/footer'); ?>
