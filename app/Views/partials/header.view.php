<?php
// app/Views/partials/header.view.php
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts & Bootstrap Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Style -->
    <link href="<?= url('/css/style.css') ?>" rel="stylesheet">
    <title><?= htmlspecialchars($pageTitle ?? 'Staj Başvuru Sistemi') ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-custom navbar-dark">
  <div class="container-fluid px-lg-4">
    <a class="navbar-brand" href="<?= url('/') ?>">
      <i class="bi bi-mortarboard-fill"></i> Staj Başvuru Sistemi
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
        <li class="nav-item">
          <a class="nav-link text-white-50 text-hover-white" href="<?= url('/') ?>">
            <i class="bi bi-house-door me-1"></i> Ana Sayfa
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white-50 text-hover-white" href="<?= url('/basvuru') ?>">
            <i class="bi bi-file-earmark-person me-1"></i> Başvuru Yap
          </a>
        </li>
        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="<?= url('/admin/dashboard') ?>">
              <i class="bi bi-speedometer2 me-1"></i> Yönetim Paneli
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-light rounded-pill px-3" href="<?= url('/logout') ?>">
              <i class="bi bi-box-arrow-right me-1"></i> Çıkış Yap
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-nav-login" href="<?= url('/login') ?>">
              <i class="bi bi-shield-lock me-1"></i> Admin Girişi
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="app-container">
    <?php if (isset($_SESSION['flash_message'])): 
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        $alertType = $message['type'] === 'error' ? 'danger' : ($message['type'] ?? 'info');
        $iconClass = $alertType === 'danger' ? 'bi-exclamation-octagon' : ($alertType === 'success' ? 'bi-check-circle' : 'bi-info-circle');
    ?>
        <div class="alert alert-<?= $alertType ?> d-flex align-items-center gap-2 rounded-3 shadow-sm mb-4" role="alert">
            <i class="bi <?= $iconClass ?> fs-5"></i>
            <div><?= htmlspecialchars($message['text']) ?></div>
        </div>
    <?php endif; ?>