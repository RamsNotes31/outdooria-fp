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
                    <th class="text-center"><?= ($invoice['status_sewa'] == 'menunggu' ? 'Action' : '') ?></th>
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
                            <span class="fs-6 fw-bold  mb-3 badge card-neoraised 
                    <?= $invoice['status_sewa'] == 'menunggu' ? 'bg-warning text-dark' : ($invoice['status_sewa'] == 'disewa' ? 'bg-primary text-white' : ($invoice['status_sewa'] == 'selesai' ? 'bg-success text-white' : 'bg-danger text-white')) ?>">
                                <?= ucfirst($invoice['status_sewa']); ?>
                            </span>
                        </td>
                        <td class="d-flex justify-content-center gap-3 text-center">
                            <?php if ($invoice['status_sewa'] == 'menunggu'): ?>
                                <a href="<?= base_url('invoice/batal/' . $invoice['id_penyewaan']) ?>"
                                    class="btn btn-danger btn-sm fw-bold border border-dark btn-neoraised mb-3">Batalkan</a>
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
    <p class="text-center text-danger fw-bold"><br>*Pesanan dapat dibatalkan. jika dalam waktu 12 jam tidak ada pembayaran, maka pesanan otomatis dibatalkan.<br><br>
        *Pembayaran yang sudah dilakukan secara offline/online tidak bisa dikembalian.</p>
    <p class="text-center mt-5 fs-5">Mohon upload bukti pembayaran online Anda</p>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="container d-flex justify-content-center align-items-center mt-5 py-5">
            <div class=" d-flex flex-column align-items-center">
                <h1 class="fs-1 fw-bolder mb-5">Transaksi Berhasil!</h1>
                <div class="d-flex align-items-center justify-content-center card-neoraised rounded-circle" style="width: 100px; height: 100px;">
                    <i class="bi bi-check-circle-fill text-success mt-2" style="font-size: 100px;"></i>
                </div>
                <h5 class="fs-4 fw-light mb-4 mt-3 text-center">Upload Foto Bukti Pembayaran Berhasil</h5>
                <h5 class="fs-4 fw-light mb-4 text-center">Untuk pengambilan barang silahkan datang ke toko kami</h5>
                <a href=" home.php" class="btn btn-lg btn-neoraised btn-primary mt-3 mb-4 fw-bold">Back to Home</a>
            </div>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="container d-flex justify-content-center align-items-center mt-5 py-5">
            <div class=" d-flex flex-column align-items-center">
                <h1 class="fs-1 fw-bolder mb-5">Transaksi Gagal!</h1>
                <div class="d-flex align-items-center justify-content-center card-neoraised rounded-circle" style="width: 100px; height: 100px;">
                    <i class="bi bi-x-circle-fill text-danger mt-2" style="font-size: 100px;"></i>
                </div>
                <h5 class="fs-4 fw-light mb-4 mt-3 text-center">Upload Foto Bukti Pembayaran Gagal</h5>
                <h5 class="fs-4 fw-light mb-4 text-center">Format foto harus berupa gambar (jpg, jpeg, png atau heic)</h5>
                <a href=" home.php" class="btn btn-lg btn-neoraised btn-primary mt-3 mb-4 fw-bold">Back to Home</a>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('invoice/bukti') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group text-center">
            <label for="image" class="form-label mb-3 fs-5">Upload Bukti Pembayaran <span class="text-danger small"></label>
            <input type="file" name="image" id="image" class="form-control card-neoraised" accept="image/jpg, image/jpeg, image/png, image/heic" required>
            <span class="text-danger"><br>*format file yang diperbolehkan: <br>.jpg, .jpeg, .png, .heic</span>
        </div>

        <div class="form-group text-center mt-3 d-flex justify-content-center">
            <button type="submit" name="submit" class="btn btn-primary btn-neoraised btn-lg mb-5 fw-bold">Upload</button>
        </div>
    </form>


    <p class="text-center mt-5 fs-5 fw-bold">Anda dapat mengunjungi Toko kami untuk melakukan pembayaran secara offline. Baru pesanan anda akan kami proses.</p>

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
</div>