<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Feedback</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Feedback</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Komentar</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Tanggal Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($feedbacks)): ?>
                    <?php foreach ($feedbacks as $feed): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($feed->id_feedback, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($feed->nama_user, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($feed->nama_alat, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($feed->id_penyewaan, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($feed->komentar, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center">(<?= htmlspecialchars($feed->rating, ENT_QUOTES, 'UTF-8') ?>)
                                <?php
                                $rating = (int) $feed->rating;
                                for ($i = 0; $i < 5; $i++) {
                                    if ($rating >= 1) {
                                        echo '<i class="bi bi-star-fill text-warning"></i>';
                                        $rating--;
                                    } elseif ($rating >= 0.5) {
                                        echo '<i class="bi bi-star-half text-warning"></i>';
                                        $rating = 0;
                                    } else {
                                        echo '<i class="bi bi-star text-warning"></i>';
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($feed->foto)): ?>
                                    <?php if (file_exists(FCPATH . 'public/img/feedback/' . $feed->foto)): ?>
                                        <img src="<?= base_url('public/img/feedback/' . $feed->foto); ?>" class="img-fluid card-neoraised border border-dark border-1 rounded-3" alt="Foto Feedback" width="150" height="150">
                                    <?php else: ?>
                                        <p class="card-text text-muted card card-neoraised p-1">Foto Telah dihapus.</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?= htmlspecialchars($feed->tanggal_feedback, ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data feedback tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Feedback</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Komentar</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Tanggal Feedback</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>