<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Loker Kita | Portal Lowongan Kerja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f5f6f8; }
        .navbar { box-shadow: 0 2px 6px rgba(0,0,0,.08); }
        .job-card:hover { transform: translateY(-3px); box-shadow: 0 4px 12px rgba(0,0,0,.1); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white">
    <div class="container">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold text-primary me-3" href="/">Loker Kita</a>
        </div>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <?php if(session('isLoggedIn')): ?>
                    <?php if(session('role') == 'perusahaan'): ?>
                        <li class="nav-item"><a class="nav-link" href="/perusahaan/lamaran">Lamaran Masuk</a></li>
                        <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard Perusahaan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/perusahaan/profile">Profil Perusahaan</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard Pelamar</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pelamar/profile">Profil Saya</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>