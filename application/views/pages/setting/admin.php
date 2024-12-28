<div class="container d-flex justify-content-center align-items-center mt-5 py-5">
    <div class="d-flex flex-column align-items-center">
        <h1 class="fs-1 fw-bolder mb-5">Profile Admin</h1>
        <div class="d-flex align-items-center justify-content-center">
            <img src="<?php echo base_url('public/img/admin/' . $admin['foto_admin']); ?>"
                alt="<?= htmlspecialchars($admin['nama_admin'], ENT_QUOTES, 'UTF-8'); ?>"
                class="img-fluid border border-dark border-3 card-neoraised rounded-pill"
                style="width: 13rem; height: 13rem; object-fit: contain;">
        </div>
        <h1 class="fs-1 fw-light mb-4 mt-5 text-center fw-bold">
            <?= htmlspecialchars($admin['nama_admin'], ENT_QUOTES, 'UTF-8'); ?>
        </h1>
        <span class="fw-bold fs-6">Joined</span>
        <span class="fw-light fs-6 mb-3">
            <?= date('d F Y', strtotime($admin['tanggal_ditambahkan'])); ?>
        </span>

        <h1 class="fs-1 fw-light mb-4 mt-5 text-center fw-bold">
            Contributions
        </h1>

        <span class="fw-bold fs-6"><?= htmlspecialchars($total_informasi); ?> kali</span>
        <span class="fw-light fs-6 mb-4">informasi diposting</span>

        <span class="fw-bold fs-6">Chat Dibalas</span>
        <span class="fw-light fs-6">
            <?= htmlspecialchars($total_chats); ?> Pesan
        </span>

        <div class="text-center mt-5">
            <h1 class="fs-1 fw-light mb-4 mt-5 text-center fw-bold">Contact Us</h1>
            <a href="mailto:<?php echo $admin['email_admin']; ?>" class="text-decoration-none" target="_blank">
                <i class="bi bi-envelope me-2 text-danger"></i><?php echo htmlspecialchars($admin['email_admin']); ?>
            </a><br>
            <a href="tel:<?php echo $admin['no_telp_admin']; ?>" class="text-decoration-none" target="_blank">
                <i class="bi bi-telephone me-2 text-primary"></i><?php echo htmlspecialchars($admin['no_telp_admin']); ?>
            </a><br>
            <a href="https://wa.me/+62<?php echo preg_replace('/^0/', '', $admin['no_telp_admin']); ?>" class="text-decoration-none" target="_blank">
                <i class="bi bi-whatsapp me-2 text-success"></i>+62<?php echo preg_replace('/^0/', '', $admin['no_telp_admin']); ?>
            </a><br>
        </div>
        <a href="<?= base_url('home'); ?>" class="btn btn-lg btn-neoraised btn-primary mt-5 mb-4 fw-bold">Back</a>
    </div>
</div>