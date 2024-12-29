<?php
defined('BASEPATH') or
	header("Location: error");
$ci = new CI_Controller();
$ci = &get_instance();
$ci->load->library('url');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?= base_url('public/img/icon.png') ?>" type="image/png" sizes="32x32">
	<title>503 | Error</title>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap"
		rel="stylesheet" />
	<script type="module" crossorigin src="<?= base_url('public/js/all.min.js') ?>"></script>
	<link rel="stylesheet" crossorigin href="<?= base_url('public/css/all.css') ?>">
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
	<div class="d-flex align-items-center justify-content-center vh-100">
		<div class="text-center">
			<h1 class="display-1 fw-bold text-dark mb-0">503</h1>
			<h2 class="display-6 fw-semibold text-secondary mb-3">
				<!-- 503 Service Unavailable -->
				<?= $message; ?>
			</h2>
			<p class="text-muted mb-4 fs-4">
				Sorry, the service is currently unavailable. Please try again later.
			</p>
			<div class="d-flex justify-content-center">
				<a href="<?= base_url('home'); ?>" class="btn btn-primary btn-neoraised btn-lg fw-bold">Kembali Ke Beranda</a>
			</div>
		</div>
	</div>
	<footer class="mt-5 py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mx-auto text-center">
					&copy; Copyright 2024,
					<a href="https://github.com/RamsNotes31/outdooria-fp" class="text-decoration-none text-dark fw-bold" target="_blank">Outdooria</a>.
				</div>
			</div>
		</div>
	</footer>
	</div>
</body>
<script>
	window.addEventListener("scroll", function() {
		if (window.scrollY > 100) {
			document.querySelector(".scroll-top").style.display = "block";
		} else {
			document.querySelector(".scroll-top").style.display = "none";
		}
	});
	document.querySelector(".scroll-top").addEventListener("click", function() {
		window.scrollTo({
			top: 0,
			behavior: "smooth"
		});
	});
</script>

</html>