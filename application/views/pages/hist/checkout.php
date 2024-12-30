<div class="container mt-5 py-5">
    <h1 class="text-center fw-bolder mb-5">Invoice Penyewewaan</h1>
    <div class="table-responsive">
        <table class="table table-borderless card-neoraised border border-dark border-3">
            <thead>
                <tr>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Barang</th>
                    <th class="text-center">Tanggal Sewa</th>
                    <th class="text-center">Tanggal Balik</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center"><?= ($invoice['status_sewa'] == 'menunggu' && empty($invoice['bukti_pembayaran']) || !file_exists(FCPATH . 'public/img/bukti/' . $invoice['bukti_pembayaran']) ? 'Action' : '') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($invoice)): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($invoice['id_penyewaan'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center"><?= htmlspecialchars($invoice['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center"><?= htmlspecialchars($invoice['nama_alat'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center"><?= date('d F Y', strtotime($invoice['tanggal_penyewaan'])) ?></td>
                        <td class="text-center"><?= date('d F Y', strtotime($invoice['tanggal_pengembalian'])) ?></td>
                        <td class="text-center">Rp. <?= number_format($invoice['total_harga'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <span class="border border-dark border-2fs-6 fw-bold  mb-3 badge card-neoraised 
                    <?= $invoice['status_sewa'] == 'menunggu' ? 'bg-warning text-dark' : ($invoice['status_sewa'] == 'disewa' ? 'bg-primary text-white' : ($invoice['status_sewa'] == 'selesai' ? 'bg-success text-white' : 'bg-danger text-white')) ?>">
                                <?= ucfirst($invoice['status_sewa']); ?>
                            </span>
                        </td>
                        <td class="d-flex justify-content-center gap-3 text-center">
                            <?php if ($invoice['status_sewa'] == 'menunggu' && empty($invoice['bukti_pembayaran']) || !file_exists(FCPATH . 'public/img/bukti/' . $invoice['bukti_pembayaran'])): ?>
                                <a href="<?= base_url('invoice/batal/' . $invoice['id_penyewaan']) ?>"
                                    class="btn btn-danger btn-sm fw-bold border border-dark btn-neoraised mb-3 border-2">Batalkan</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data invoice.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <?php if ($this->session->flashdata('successs')): ?>
        <div class="alert alert-success-neoraised alert-success fw-bolder alert-dismissible fade show text-center" role="alert">
            <?= $this->session->flashdata('successs') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php elseif ($this->session->flashdata('errorr')): ?>
        <div class="alert alert-success-neoraised alert-success fw-bolder alert-dismissible fade show text-center" role="alert">
            <?= $this->session->flashdata('errorr') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php elseif ($this->session->flashdata('sudah')): ?>
        <div class="alert alert-danger-neoraised alert-danger fw-bolder alert-dismissible fade show text-center" role="alert">
            <?= $this->session->flashdata('sudah') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php elseif ($this->session->flashdata('up')): ?>
        <div class="alert alert-success-neoraised alert-success fw-bolder alert-dismissible fade show text-center" role="alert">
            <?= $this->session->flashdata('up') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php elseif ($this->session->flashdata('ga')): ?>
        <div class="alert alert-danger-neoraised alert-danger fw-bolder alert-dismissible fade show text-center" role="alert">
            <?= $this->session->flashdata('ga') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($invoice['status_sewa'] == 'menunggu'): ?>
        <?php if (empty($invoice['bukti_pembayaran'])): ?>
            <p class="text-center text-danger fw-bold"><br>*Pesanan dapat dibatalkan. jika dalam waktu 12 jam tidak ada pembayaran, maka pesanan otomatis dibatalkan.<br><br>
                *Pembayaran yang sudah dilakukan secara offline/online tidak bisa dikembalian.</p>
            <p class="text-center mt-5 fs-5">Mohon upload bukti pembayaran online Anda</p>

            <form action="<?= base_url('invoice/bukti') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group text-center">
                    <label for="image" class="form-label mb-3 fs-5">Upload Bukti Pembayaran <span class="text-danger small"></span></label>
                    <input type="file" name="image" id="image" class="form-control card-neoraised" accept="image/jpg, image/jpeg, image/png, image/heic" required onchange="previewFileImage()">
                    <span class="text-danger"><br>*format file yang diperbolehkan: <br>.jpg, .jpeg, .png, .heic</span>
                </div>
                <div class="form-group text-center">
                    <label for="id_penyewaan" class="visually-hidden">ID Penyewaan</label>
                    <input type="hidden" id="id_penyewaan" name="id_penyewaan" value="<?= htmlspecialchars($invoice['id_penyewaan'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center">
                    <label for="nama" class="visually-hidden">Nama</label>
                    <input type="hidden" id="nama" name="nama" value="<?= htmlspecialchars($invoice['nama'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center">
                    <label for="nama_alat" class="visually-hidden">Nama Alat</label>
                    <input type="hidden" id="nama_alat" name="nama_alat" value="<?= htmlspecialchars($invoice['nama_alat'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center">
                    <label for="tanggal_sewa" class="visually-hidden">Tanggal Sewa</label>
                    <input type="hidden" id="tanggal_sewa" name="tanggal_sewa" value="<?= htmlspecialchars($invoice['tanggal_penyewaan'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center">
                    <label for="tanggal_balik" class="visually-hidden">Tanggal Balik</label>
                    <input type="hidden" id="tanggal_balik" name="tanggal_balik" value="<?= htmlspecialchars($invoice['tanggal_pengembalian'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center">
                    <label for="harga" class="visually-hidden">Harga</label>
                    <input type="hidden" id="harga" name="harga" value="<?= htmlspecialchars($invoice['total_harga'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center">
                    <label for="status" class="visually-hidden">Status</label>
                    <input type="hidden" id="status" name="status" value="<?= htmlspecialchars($invoice['status_sewa'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group text-center mt-3">
                    <img id="image-preview" src="" alt="Image Preview" class="img-fluid border border-dark border-3 card-neoraised d-none" style="width: 20rem; height: 15rem; object-fit: contain;">
                </div>

                <div class="form-group text-center mt-3 d-flex justify-content-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Upload</button>
                </div>
            </form>

            <script>
                function previewFileImage() {
                    const preview = document.getElementById('image-preview');
                    const file = document.getElementById('image').files[0];
                    const reader = new FileReader();
                    const submitButton = document.querySelector('button[name="submit"]');

                    reader.addEventListener("load", function() {
                        preview.src = reader.result;
                        preview.classList.remove('d-none');
                        if (file.type.match('image.*')) {
                            submitButton.disabled = false;
                        } else {
                            submitButton.disabled = true;
                            preview.classList.add('d-none');
                        }
                    }, false);

                    if (file) {
                        reader.readAsDataURL(file);
                    }
                }
            </script>


            <p class="text-center mt-5 fs-5 fw-bold">Anda dapat mengunjungi Toko kami untuk melakukan pembayaran secara offline. Baru pesanan anda akan kami proses.</p>
        <?php else: ?>

            <?php if (file_exists(FCPATH . 'public/img/bukti/' . $invoice['bukti_pembayaran'])): ?>
                <div class="container d-flex justify-content-center align-items-center mt-5 py-5">
                    <div class=" d-flex flex-column align-items-center">
                        <h1 class="fs-1 fw-bolder mb-5">Transaksi Berhasil!</h1>
                        <div class="d-flex align-items-center justify-content-center card-neoraised rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-check-circle-fill text-success mt-2" style="font-size: 100px;"></i>
                        </div>
                        <h5 class="fs-4 fw-light mb-4 mt-3 text-center">Upload Foto Bukti Pembayaran Berhasil</h5>
                        <h5 class="fs-4 fw-light mb-4 text-center">Tunggu Konfirmasi Lebih Lanjut</h5>
                    </div>
                </div>

                <p class="text-center mt-3 fs-5 fw-light mb-5">Pembayaran telah dilakukan, silakan mengambil barang di tempat penyewaan. Untuk status sewa akan kami proses setelah barang diambil ditempat kami.</p>

                <div class="form-group text-center mt-5 d-flex justify-content-center mb-5">
                    <a href="<?= base_url('home') ?>" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Kembali</a>
                </div>
                <p class="text-center mt-5 fs-5 fw-bold">Alamat lengkap kami.</p>

            <?php else: ?>
                <div class="container d-flex justify-content-center align-items-center mt-5 py-5">
                    <div class=" d-flex flex-column align-items-center">
                        <h1 class="fs-1 fw-bolder mb-5">Transaksi Gagal!</h1>
                        <div class="d-flex align-items-center justify-content-center card-neoraised rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-x-circle-fill text-danger mt-2" style="font-size: 100px;"></i>
                        </div>
                        <h5 class="fs-4 fw-light mb-4 mt-3 text-center">Upload Foto Bukti Pembayaran Gagal</h5>
                        <h5 class="fs-4 fw-light mb-4 text-center">File Mungkin Corrupt atau Tidak Sesuai silahkan upload ulang</h5>

                        <form action="<?= base_url('invoice/bukti') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group text-center">

                                <label for="image" class="form-label mb-3 fs-5">Upload Ulang Bukti Pembayaran <span class="text-danger small"></span></label>
                                <input type="file" name="image" id="image" class="form-control card-neoraised" accept="image/jpg, image/jpeg, image/png, image/heic" required onchange="previewFileImage()">
                                <span class="text-danger"><br>*format file yang diperbolehkan: <br>.jpg, .jpeg, .png, .heic</span>
                            </div>
                            <div class="form-group text-center">
                                <label for="id_penyewaan" class="visually-hidden">ID Penyewaan</label>
                                <input type="hidden" id="id_penyewaan" name="id_penyewaan" value="<?= htmlspecialchars($invoice['id_penyewaan'], ENT_QUOTES, 'UTF-8') ?>">
                            </div>
                            <div class="form-group text-center mt-3">
                                <img id="image-preview" src="" alt="Image Preview" class="img-fluid border border-dark border-3 card-neoraised d-none" style="width: 20rem; height: 15rem; object-fit: contain;">
                            </div>

                            <div class="form-group text-center mt-3 d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Upload</button>
                            </div>
                        </form>

                        <script>
                            function previewFileImage() {
                                const preview = document.getElementById('image-preview');
                                const file = document.getElementById('image').files[0];
                                const reader = new FileReader();
                                const submitButton = document.querySelector('button[name="submit"]');

                                reader.addEventListener("load", function() {
                                    preview.src = reader.result;
                                    preview.classList.remove('d-none');
                                    if (file.type.match('image.*')) {
                                        submitButton.disabled = false;
                                    } else {
                                        submitButton.disabled = true;
                                        preview.classList.add('d-none');
                                    }
                                }, false);

                                if (file) {
                                    reader.readAsDataURL(file);
                                }
                            }
                        </script>

                    </div>
                </div>

                <p class="text-center mt-4 fs-5 fw-light">Atau anda dapat mengunjungi Toko kami untuk melakukan pembayaran secara offline. Baru pesanan anda akan kami proses.</p>
            <?php endif; ?>
        <?php endif; ?>


    <?php endif; ?>

    <?php if ($invoice['status_sewa'] == 'batal'): ?>

        <p class="text-center mt-5 fs-5 fw-light mb-5">Penyewaan dibatalkan, jika ingin melihat kondisi barang-barang silakan kunjungi toko kami.</p>

        <div class="form-group text-center mt-5 d-flex justify-content-center mb-5">
            <a href="<?= base_url('home') ?>" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Kembali</a>
        </div>
        <p class="text-center mt-5 fs-5 fw-bold">Alamat lengkap kami.</p>
    <?php endif; ?>

    <?php if ($invoice['status_sewa'] == 'disewa'): ?>

        <p class="text-center mt-5 fs-5 fw-light mb-5">Pembayaran telah dilakukan, silakan mengambil barang di tempat penyewaan.</p>

        <div class="form-group text-center mt-5 d-flex justify-content-center mb-5">
            <a href="<?= base_url('home') ?>" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Kembali</a>
        </div>
        <p class="text-center mt-5 fs-5 fw-bold">Alamat lengkap kami.</p>
    <?php endif; ?>

    <?php if ($invoice['status_sewa'] == 'batal' || $invoice['status_sewa'] == 'disewa' || $invoice['status_sewa'] == 'menunggu'): ?>

        <div class="container">
            <div class="map-container card-neoraised border border-dark border-2 rounded-3" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                <iframe src="https://www.google.com/maps/embed/v1/place?q=-7.720941,+110.365193&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                    width="600"
                    height="450"
                    style="border:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                    allowfullscreen=""
                    loading="lazy">

                    <style>
                        #google-maps-display img {
                            max-width: none !important;
                            background: none !important;
                            font-size: inherit;
                            font-weight: inherit;
                        }
                    </style>
                </iframe>
            </div>
        </div>
        <p class="text-center mt-3 fs-5 fw-light">Alamat : Penggung | Tridadi, Sleman, Sleman Regency, Special Region of Yogyakarta</p>
    <?php endif; ?>

    <?php if ($invoice['status_sewa'] == 'selesai'): ?>

        <p class="text-center mt-5 fs-5 fw-light mb-5">Penyewaan telah selesai, terima kasih telah melakukan penyewaan ditempat kami, jangan lupa untuk kasih riview dan rating dibawah ini.</p>

        <div class="form-group text-center mt-5 d-flex justify-content-center mb-5">
            <a href="<?= base_url('home') ?>" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Kembali</a>
        </div>

        <div class="row">
            <div class="col-lg-6 order-lg-2">
                <p class="text-center fs-5 py-5 mt-5">Jika ingin melakukan penyewaan lagi, silakan kunjungi ketempat toko kami.</p>
                <div class="container">
                    <div class="map-container card-neoraised border border-dark border-2 rounded-3" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                        <iframe src="https://www.google.com/maps/embed/v1/place?q=-7.720941,+110.365193&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                            width="600"
                            height="450"
                            style="border:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                            allowfullscreen=""
                            loading="lazy">

                            <style>
                                #google-maps-display img {
                                    max-width: none !important;
                                    background: none !important;
                                    font-size: inherit;
                                    font-weight: inherit;
                                }
                            </style>
                        </iframe>
                    </div>
                </div>
                <p class="text-center mt-3 fs-5 fw-light mb-5">Alamat : Penggung | Tridadi, Sleman, Sleman Regency, Special Region of Yogyakarta</p>

            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="text-center mt-md-5 py-5 fw-bolder">Rating & Review</h2>
                <div class="rating-review-form">
                    <?php ini_set('memory_limit', '-1'); ?>
                    <form method="post" action="<?= base_url('invoice/review') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_alat" class="visually-hidden">Nama Alat</label>
                            <input type="hidden" id="nama_alat" name="nama_alat" value="<?= htmlspecialchars($invoice['nama_alat'], ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_penyewaan" class="visually-hidden">Invoice</label>
                            <input type="hidden" id="id_penyewaan" name="id_penyewaan" value="<?= htmlspecialchars($invoice['id_penyewaan'], ENT_QUOTES, 'UTF-8') ?>">
                            <label for="userRating" class="form-label mt-5">Your Rating: <span id="rating-text"><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i></span></label>
                            <div class="d-flex align-items-center">
                                <input type="range" id="userRating" name="rating" class="form-control card-neoraised" min="0" max="5" step="0.5" value="0" required>

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
                        </div>
                        <div class="form-group mt-3">
                            <label for="userComment" class="form-label">Your Comment:</label>
                            <textarea id="userComment" name="comment" class="form-control card-neoraised" rows="4" required style="resize: none;"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="userPhoto" class="form-label">Upload Your Photo:</label>
                            <div class="input-group mb-3">
                                <input type="file" id="userPhoto" name="photo" class="form-control card-neoraised" accept=".jpeg, .jpg, .png, .heic" onchange="previewFile()">
                            </div>
                            <img src="" class="img-fluid border border-dark border-3 card-neoraised d-none" id="preview-image" style="width: 15rem; height: 10rem; object-fit: contain;">
                            <p id="fileError" class="text-danger d-none">*Ukuran file terlalu besar. Maksimal 2 MB.</p>
                            <p id="fileError" class="text-danger d-none">*Hanya support image (.jpeg, .jpg, .png, .heic)</p>
                        </div>


                        <button type="submit" class="btn btn-neoraised btn-success mt-3 fw-bold">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function previewFile() {
                const preview = document.getElementById('preview-image');
                const file = document.getElementById('userPhoto').files[0];
                const fileError = document.getElementById('fileError');
                const submitButton = document.querySelector('button[type="submit"]');
                if (file) {
                    const fileType = file.type;
                    if (fileType.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onloadend = function() {
                            preview.src = reader.result;
                            preview.alt = file.name;
                            preview.classList.remove('d-none');
                            fileError.classList.add('d-none');
                            submitButton.disabled = false;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = "";
                        preview.alt = "";
                        preview.classList.add('d-none');
                        fileError.classList.remove('d-none');
                        submitButton.disabled = true;
                    }
                }

                const userPhoto = document.getElementById('userPhoto');
                userPhoto.addEventListener('change', function() {
                    const file = this.files[0];
                    const fileError = document.getElementById('fileError');
                    if (file && file.size > 2 * 1024 * 1024) { // Maksimal 2 MB
                        fileError.textContent = '*Ukuran file terlalu besar. Maksimal 2 MB.';
                        fileError.classList.remove('d-none');
                        this.value = ''; // Reset input file
                    } else {
                        fileError.classList.add('d-none');
                    }
                });

            }
        </script>

        <div class="user-reviews mt-5 py-5">
            <h3 class="text-center mb-5 py-5 mt-5 fw-bolder">New Reviews</h3>
            <?php if (!empty($feedbacks)): ?>
                <?php foreach ($feedbacks as $feedback): ?>
                    <div class="col-12 mt-5">
                        <div class="card card-neoraised mb-3">
                            <div class="mx-3 my-3">
                                <div class="d-flex justify-space-between">
                                    <!-- Gambar Profil Placeholder -->
                                    <img src="<?= empty($feedback->foto_profil) ? base_url('public/img/user/deleted.jpg') : base_url('public/img/user/' . $feedback->foto_profil); ?>" \
                                        alt="<?= $feedback->nama_user; ?>" \
                                        class="rounded-circle me-2 mb-3 border border-2 border-dark card-neoraised"
                                        width="40" height="40">
                                    <!-- Nama User -->
                                    <a href="<?= base_url('akun/profil/' . ($feedback->nama_user)); ?>" class="d-flex align-items-center text-decoration-none">
                                        <h5 class="card-title fw-bold align-self-center"><?= htmlspecialchars($feedback->nama_user, ENT_QUOTES, 'UTF-8'); ?></h5>
                                    </a>


                                </div>
                                <!-- Komentar -->
                                <p class="card-text fw-light mt-3">"<?= $feedback->komentar; ?>"</p>
                                <?php if (!empty($feedback->foto)): ?>
                                    <?php if (file_exists(FCPATH . 'public/img/feedback/' . $feedback->foto)): ?>
                                        <img src="<?= base_url('public/img/feedback/' . $feedback->foto); ?>" class="img-fluid card-neoraised border border-dark border-1 rounded-3 mb-5" alt="Foto Feedback" width="150" height="150">
                                    <?php else: ?>
                                        <p class="card-text text-muted card card-neoraised p-1">Foto Telah dihapus.</p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="d-block">
                                    <!-- Tanggal Feedback -->
                                    <p class="card-text fw-light"><small
                                            class="text-muted">
                                            <?= date('F d, Y H:i:s', strtotime($feedback->tanggal_feedback)); ?>
                                        </small></p>
                                    <!-- Nama Alat dan Rating -->
                                    <p class="card-text me-5"><small class="text-muted fw-bold"><?= $feedback->nama_alat; ?></small>
                                        <?php
                                        $rating = floor($feedback->rating); // Ambil nilai bulat bawah dari rating
                                        $hasHalfStar = ($feedback->rating - $rating) >= 0.5; // Cek apakah ada setengah bintang

                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="bi bi-star-fill text-warning"></i>'; // Bintang penuh
                                            } elseif ($hasHalfStar && $i == $rating + 1) {
                                                echo '<i class="bi bi-star-half text-warning"></i>'; // Bintang setengah
                                                $hasHalfStar = false; // Set sudah digunakan
                                            } else {
                                                echo '<i class="bi bi-star text-muted"></i>'; // Bintang kosong
                                            }
                                        }
                                        ?><small class="text-muted fw-bold"> <?= number_format(htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'), 1); ?>/5.0</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No feedback data available.</p>
            <?php endif; ?>
        </div>

    <?php endif; ?>
</div>