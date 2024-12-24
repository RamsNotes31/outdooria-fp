<?php
$title = " | 404";
include './templates/header3.php'; ?>

<div
    class="container container-full-height d-flex align-items-center justify-content-center">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-dark mb-0">404</h1>
        <h2 class="display-6 fw-semibold text-secondary mb-3">
            Page Not Found!
        </h2>
        <p class="text-muted mb-4 fs-4">
            We're sorry, but the page you are looking for cannot be found. It might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        <div class="d-flex justify-content-center">
            <a href="home.php" class="btn btn-primary btn-neoraised btn-lg fw-bold">Kembali Ke Beranda</a>
        </div>
    </div>
</div>

<?php include './templates/footer.php'; ?>