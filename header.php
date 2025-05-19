<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Gudang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php
include 'auth.php'
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Arsip - Rumah Joglo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                 <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Kwitansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="asset.php">Asset Gedung</a>
                </li>
            </ul>
            <style>
                .dropdown-toggle::after {
                    display: none;
                }
            </style>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-flex align-items-center">
                    <span class="nav-link me-2">Hi, <?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?> </span>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Akun
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    
                </li>
            </ul>

           
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-tzxNVTUQKnijBgmD5wM9BXm8amScQ5L7FDzH6tqNVxkuT7ZFIM7Fc/NrDJBLulc8" crossorigin="anonymous"></script>
        </div>
    </div>
</nav>

<div class="container">
