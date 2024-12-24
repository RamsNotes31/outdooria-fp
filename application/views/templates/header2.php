<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/icon.png" type="image/png" sizes="32x32">
    <title class="fw-bold">Hikyu<?= $title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet" />
    <script type="module" crossorigin src="./assets/bundled/js/all.min.js"></script>
    <link rel="stylesheet" crossorigin href="./assets/bundled/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    .scroll-top {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
        display: none;
        z-index: 1000;
    }
</style>
<body>
    <div class="bs-component">
        <nav class="navbar navbar-neoraised-bottom navbar-expand-lg bg-success navbar-dark p-3">
            <div class="container-fluid">
                <h1 class="navbar-brand fs-1 mx-auto mt-2 order-1 order-lg-2 fw-bolder" type="button"
                    href="home.php">Outdooria</h1>
            </div>
            <button class="btn btn-success btn-neoraised border border-3 border-dark position-absolute ms-2 btn-lg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="navbar-toggler-icon" style="filter: invert(100%);"></span></button>
        </nav>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 300px;">
            <div class="offcanvas-header card-neoraised">
                <span class="badge badge-lg card-neoraised rounded-pill bg-light border border-dark text-dark me-2 fw-bold">Settings</span>
                <h5 class="offcanvas-title fw-bold" id="offcanvasRightLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small card-neoraised">
                <div class="d-flex flex-column gap-3">
                    <a href="akun.php" class="btn btn-neoraised btn-success fw-bold">Ubah Data</a>
                    <a href="riwayat.php" class="btn btn-neoraised btn-warning fw-bold">Riwayat</a>
                    <a href="favorit.php" class="btn btn-neoraised btn-danger fw-bold">Daftar Favorit</a>
                    <a href="home.php" class="btn btn-neoraised btn-primary fw-bold">Back to Home</a>
                    <a href="./logout.php" class="btn btn-neoraised btn-info fw-bold">Logout</a>
                </div>
            </div>
        </div>

        <div class="scroll-top">
            <button class="btn btn-neoraised btn-warning btn-md-lg">
                <i class="bi bi-chevron-up"></i>
            </button>
        </div>