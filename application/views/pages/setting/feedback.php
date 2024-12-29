<div class="container mt-5 py-5">
    <h1 class="text-center fw-bolder mb-5">Feedback Saya</h1>
    <div class="table-responsive">
        <table id="datatable1" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Alat</th>
                    <th class="text-center">Komentar</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Tanggal Post</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($feed as $feedback): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($feedback['nama_alat'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center"><?= htmlspecialchars($feedback['komentar'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center">
                            <?php
                            $rating = (int) $feedback['rating'];
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="bi bi-star-fill text-warning"></i>';
                                } elseif ($rating >= ($i - 0.5)) {
                                    echo '<i class="bi bi-star-half text-warning"></i>';
                                    $rating = 0;
                                } else {
                                    echo '<i class="bi bi-star text-muted"></i>';
                                }
                            }
                            ?><br><span class="fw-light"><?= $feedback['rating'] ?>/5.0</span>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($feedback['foto'])): ?>
                                <?php if (file_exists(FCPATH . 'public/img/feedback/' . $feedback['foto'])): ?>
                                    <img src="<?= base_url('public/img/feedback/' . $feedback['foto']); ?>" class="img-fluid card-neoraised border border-dark border-1 rounded-3" alt="Foto Feedback" width="100" height="100">
                                <?php else: ?>
                                    <p class="card-text text-muted card card-neoraised p-1">Foto Telah dihapus.</p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= htmlspecialchars($feedback['tanggal_feedback'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="d-flex justify-content-center gap-3 text-center">
                            <button type="button" class="btn btn-warning btn-sm fw-bold border border-dark btn-neoraised mb-3" data-bs-toggle="modal" data-bs-target="#editModal<?= $feedback['id_feedback'] ?>">Edit</button>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $feedback['id_feedback'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content card-neoraised border border-dark border-3">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="exampleModalLabel">Edit Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('akun/editfeed/' . $feedback['id_feedback']) ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama_alat" class="visually-hidden">Nama Alat</label>
                                                    <input type="hidden" id="id_feedback" name="id_feedback" value="<?= $feedback['id_feedback'] ?>">
                                                    <input type="hidden" id="id_alat" name="id_alat" value="<?= $feedback['id_alat'] ?>">
                                                    <input type="hidden" id="id_user" name="id_user" value="<?= $feedback['id_user'] ?>">
                                                    <label for="userRating" class="form-label mt-5">Your Rating: <span id="rating-text">
                                                            <?php
                                                            $rating = (int) $feedback['rating'];
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $rating) {
                                                                    echo '<i class="bi bi-star-fill text-warning"></i>';
                                                                } elseif ($rating >= ($i - 0.5)) {
                                                                    echo '<i class="bi bi-star-half text-warning"></i>';
                                                                    $rating = 0;
                                                                } else {
                                                                    echo '<i class="bi bi-star text-muted"></i>';
                                                                }
                                                            }
                                                            ?>

                                                        </span></label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="range" id="userRating" name="rating" class="form-control card-neoraised" min="0" max="5" step="0.5" value="<?= $feedback['rating'] ?>" required>

                                                    </div>

                                                </div>
                                                <script>
                                                    const ratingInput = document.getElementById('userRating');
                                                    const ratingText = document.getElementById('rating-text');
                                                    ratingInput.addEventListener('input', function() {
                                                        const rating = Number(ratingInput.value);
                                                        const stars = [];
                                                        for (let i = 0; i < 5; i++) {
                                                            if (rating >= (i + 1)) {
                                                                stars.push('<i class="bi bi-star-fill text-warning"></i>');
                                                            } else if (rating >= (i + 0.5)) {
                                                                stars.push('<i class="bi bi-star-half text-warning"></i>');
                                                            } else {
                                                                stars.push('<i class="bi bi-star text-muted"></i>');
                                                            }
                                                        }
                                                        ratingText.innerHTML = stars.join('');
                                                    });
                                                </script>
                                                <div class="form-group mt-3">
                                                    <label for="userComment" class="form-label">Your Comment:</label>
                                                    <textarea id="userComment" name="comment" class="form-control card-neoraised" rows="4" required style="resize: none;"><?= $feedback['komentar'] ?></textarea>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="foto" class="form-label">Upload Your Photo:</label>
                                                    <input type="file" id="foto" name="foto" class="form-control card-neoraised" accept=".jpg, .jpeg, .png, .heic">
                                                </div>
                                                <input type="hidden" id="datetime-local" name="tanggal_feedback" value="<?= date('Y-m-d\TH:i', time() + (7 * 60 * 60)) ?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-neoraised fw-bold" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-neoraised fw-bold">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-danger btn-sm fw-bold border border-dark btn-neoraised mb-3 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hapus
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item fw-bold" href="<?= base_url('akun/hapusfeed/' . $feedback['id_feedback']) ?>">Hapus Feedback</a></li>
                                    <?php if (!empty($feedback['foto'])): ?>
                                        <li><a class="dropdown-item fw-bold" href="<?= base_url('akun/hapusfoto/' . $feedback['id_feedback']) ?>">Hapus Gambar</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Alat</th>
                    <th class="text-center">Komentar</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Tanggal Post</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>