<div class="container d-flex justify-content-center align-items-center mt-5 py-5">
    <div class="d-flex flex-column align-items-center">
        <h1 class="fs-1 fw-bolder mb-5">Profile User</h1>
        <div class="d-flex align-items-center justify-content-center">
            <img src="<?php echo base_url('public/img/user/' . $user['foto_profil']); ?>"
                alt="<?= htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8'); ?>"
                class="img-fluid border border-dark border-3 card-neoraised rounded-pill"
                style="width: 13rem; height: 13rem; object-fit: contain;">
        </div>
        <h1 class="fs-1 fw-light mb-4 mt-5 text-center fw-bold">
            <?= htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8'); ?>
        </h1>
        <span class="fw-bold fs-6">Joined</span>
        <span class="fw-light fs-6">
            <?= date('d F Y', strtotime($user['tanggal_daftar'])); ?>
        </span>

        <h1 class="fs-1 fw-light mb-4 mt-5 text-center fw-bold">
            Contributions
        </h1>

        <span class="fw-bold fs-6">Total Penyewaan</span>
        <span class="fw-light fs-6 mb-4">
            <?= empty($total_penyewaan->total_penyewaan) ? 0 : $total_penyewaan->total_penyewaan; ?> | <?= empty($top_barang->nama_alat) ? "Belum ada penyewaan" : $top_barang->nama_alat . ' (' . $top_barang->jumlah_disewa . ')'; ?>
        </span>

        <span class="fw-bold fs-6">Total Feedback</span>
        <span class="fw-light fs-6 mb-5">
            <?= $feedback_stats->total_feedback; ?> |
            <?php
            $rating = (float) $feedback_stats->rata_rata_feedback;
            for ($i = 0; $i < 5; $i++) {
                if ($rating >= 1) {
                    echo '<i class="bi bi-star-fill text-warning"></i>';
                    $rating--;
                } else if ($rating >= 0.5) {
                    echo '<i class="bi bi-star-half text-warning"></i>';
                    $rating = 0;
                } else {
                    echo '<i class="bi bi-star text-dark"></i>';
                }
            }
            ?>
            (<?= number_format((float) $feedback_stats->rata_rata_feedback, 1); ?>)
        </span>
        <a href="<?= base_url('home'); ?>" class="btn btn-lg btn-neoraised btn-primary mt-5 mb-4 fw-bold">Back</a>
    </div>
</div>