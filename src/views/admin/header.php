<!--
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 -->
<?php include_once __DIR__ . '/../view_helpers.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin Dashboard' ?> | Simple CMS</title>
    <meta name="author" content="Simple CMS">
    <meta name="license" content="CC BY 4.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">    <!-- Stili personalizzati -->
    <link href="<?= base_path('/src/assets/css/backend/style.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="d-flex align-items-center pb-3 mb-3 border-bottom">
                        <h3 class="fs-4 fw-bold ps-2 text-white">CMS Admin</h3>                    </div>                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_path('/admin/dashboard') ?>">
                                <i class="fas fa-home me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_path('/admin/articles') ?>">
                                <i class="fas fa-file-alt me-2"></i>
                                Articoli
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_path('/admin/categories') ?>">
                                <i class="fas fa-folder me-2"></i>
                                Categorie
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_path('/admin/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom dashboard-header">
                    <h1 class="h2"><?= $pageTitle ?? 'Dashboard' ?></h1>
                    <?php if(isset($_SESSION['username'])): ?>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <span class="text-muted">Benvenuto, <?= htmlspecialchars($_SESSION['username']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>