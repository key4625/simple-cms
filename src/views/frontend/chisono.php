<?php
$pageTitle = 'Chi sono';
$template = SimpleCMS\TemplateEngine::getInstance();
$template->include('frontend/header', ['pageTitle' => $pageTitle]);
?>

<div class="container mt-5">
    <!-- Header biografico con breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi sono</li>
        </ol>
    </nav>
    
    <!-- Introduzione -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-4 mb-4">Chi sono</h1>
            <p class="lead">Web developer e designer con oltre 10 anni di esperienza nella creazione di soluzioni web professionali e innovative.</p>
            <hr class="my-4">
        </div>
    </div>
    
    <!-- Biografia principale con foto -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h2 class="card-title">La mia storia</h2>
                    <p class="card-text">Mi sono avvicinato al mondo dell'informatica all'età di 14 anni, quando ho iniziato a programmare in BASIC su un vecchio computer. Da allora, la mia passione per la tecnologia e la programmazione non ha fatto altro che crescere.</p>
                    <p class="card-text">Ho conseguito una laurea in Informatica presso l'Università di Milano nel 2015, e da allora ho lavorato come sviluppatore web freelance e presso diverse aziende del settore tech.</p>
                    <p class="card-text">La mia specializzazione è lo sviluppo di applicazioni web utilizzando tecnologie moderne come PHP, JavaScript, CSS e framework come Laravel e Vue.js.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <img src="https://images.unsplash.com/photo-1537432376769-00f5c2f4c8d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sviluppatore al lavoro" class="img-fluid rounded shadow-sm" style="object-fit: cover; height: 100%; width: 100%;">
        </div>
    </div>
    
    <!-- Competenze -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Competenze</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-code fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-1">Sviluppo Frontend</h5>
                                    <p class="text-muted mb-0">HTML5, CSS3, JavaScript, React, Vue.js</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-server fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-1">Sviluppo Backend</h5>
                                    <p class="text-muted mb-0">PHP, Laravel, Node.js, Python</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-database fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-1">Database</h5>
                                    <p class="text-muted mb-0">MySQL, PostgreSQL, MongoDB</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-paint-brush fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-1">Design</h5>
                                    <p class="text-muted mb-0">UI/UX, Responsive Design, Bootstrap</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-mobile-alt fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-1">Mobile</h5>
                                    <p class="text-muted mb-0">App Ibride, React Native</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-tools fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-1">DevOps</h5>
                                    <p class="text-muted mb-0">Git, Docker, CI/CD, AWS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Esperienza lavorativa con timeline -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Esperienza lavorativa</h2>
                    <div class="timeline">
                        <div class="row g-0 mb-4">
                            <div class="col-md-2 text-md-end pe-md-4">
                                <p class="fw-bold text-primary mb-0">2022 - Presente</p>
                            </div>
                            <div class="col-md-10">
                                <h5>Senior Web Developer</h5>
                                <p class="text-muted">TechSolutions S.r.l., Milano</p>
                                <p>Sviluppo e manutenzione di applicazioni web enterprise utilizzando Laravel, Vue.js e Docker. Coordinamento di un team di 3 sviluppatori junior.</p>
                            </div>
                        </div>
                        <div class="row g-0 mb-4">
                            <div class="col-md-2 text-md-end pe-md-4">
                                <p class="fw-bold text-primary mb-0">2018 - 2022</p>
                            </div>
                            <div class="col-md-10">
                                <h5>Fullstack Developer</h5>
                                <p class="text-muted">WebInnovation, Roma</p>
                                <p>Sviluppo di siti web ed e-commerce per clienti di vari settori. Implementazione di soluzioni personalizzate basate su PHP e JavaScript.</p>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-2 text-md-end pe-md-4">
                                <p class="fw-bold text-primary mb-0">2015 - 2018</p>
                            </div>
                            <div class="col-md-10">
                                <h5>Web Developer Freelance</h5>
                                <p class="text-muted">Libero professionista</p>
                                <p>Creazione di siti web per piccole e medie imprese. Consulenza e formazione su WordPress e sistemi di gestione contenuti.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Galleria fotografica -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="mb-4">Galleria fotografica</h2>
        </div>
        <div class="col-md-4 mb-4">
            <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Laptop con codice" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-4 mb-4">
            <img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Meeting di lavoro" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-4 mb-4">
            <img src="https://images.unsplash.com/photo-1522252234503-e356532cafd5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Codice su schermo" class="img-fluid rounded shadow-sm">
        </div>
    </div>
    
    <!-- Hobby e interessi personali -->
    <div class="row mb-5">
        <div class="col-md-5 mb-4">
            <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Montagna al tramonto" class="img-fluid rounded shadow-sm h-100" style="object-fit: cover;">
        </div>
        <div class="col-md-7 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h2 class="card-title">Hobby e interessi</h2>
                    <p class="card-text">Quando non sono davanti al computer, amo esplorare la natura e fare trekking in montagna. Sono un appassionato di fotografia paesaggistica e adoro catturare la bellezza dei luoghi che visito.</p>
                    <p class="card-text">Sono anche un grande lettore, soprattutto di saggi scientifici e romanzi di fantascienza. Tra i miei autori preferiti ci sono Isaac Asimov, Philip K. Dick e Ted Chiang.</p>
                    <p class="card-text">Mi piace condividere le mie conoscenze tecniche, e occasionalmente tengo workshop e corsi di programmazione per principianti presso associazioni culturali locali.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contatti -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 bg-light shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h2 class="mb-3">Vuoi contattarmi?</h2>
                        <p class="lead mb-4">Sono sempre aperto a nuove opportunità di collaborazione e progetti interessanti.</p>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-primary mx-2"><i class="fas fa-envelope me-2"></i>Email</a>
                            <a href="#" class="btn btn-outline-dark mx-2"><i class="fab fa-linkedin me-2"></i>LinkedIn</a>
                            <a href="#" class="btn btn-outline-dark mx-2"><i class="fab fa-github me-2"></i>GitHub</a>
                        </div>
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

<?php $template->include('frontend/footer'); ?>
