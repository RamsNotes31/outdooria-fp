<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('public/img/icon.png'); ?>" type="image/png" sizes="32x32">
    <title><?= $title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet" />
    <script type="module" crossorigin src="<?= base_url('public/js/all.min.js'); ?>"></script>
    <link rel="stylesheet" crossorigin href="<?= base_url('public/css/all.css'); ?>">
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
                <div class="collapse navbar-collapse align-items-center  justify-content-start mb-4 order-2 order-lg-1" id="navbarColor01"">
                <a href=" <?= base_url('home'); ?>" class="btn btn-lg btn-neoraised btn-light mt-3 me-3 fw-bold">Home</a>
                    <a href="<?= base_url('produk'); ?>" class="btn btn-lg btn-neoraised btn-light mt-3 me-3 fw-bold">Rental</a>
                    <a href="<?= base_url('gunung'); ?>" class="btn btn-lg btn-neoraised btn-light mt-3 me-3 fw-bold">Information</a>
                    <div class="btn-group btn-group-neoraised mt-3 me-3" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-lg btn-light fw-bold">Account</button>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-lg btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <?php include 'option.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="navbar-brand fs-1 mx-auto mt-2 order-1 order-lg-2 fw-bolder me-lg-5" type="button"
                    href="home.php">Outdooria</h1>
                <button
                    class="navbar-toggler btn-neoraised btn-dark border border-3 border-dark"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarColor01"
                    aria-controls="navbarColor01"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="filter: invert(100%);"></span>
            </div>
        </nav>
        <div class="scroll-top">
            <button class="btn btn-neoraised btn-warning btn-md-lg">
                <i class="bi bi-chevron-up"></i>
            </button>
        </div>