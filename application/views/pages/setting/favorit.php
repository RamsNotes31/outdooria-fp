<div class="container mt-5 py-5">
    <h1 class="text-center fw-bolder mb-5">Favorit Saya</h1>

    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $produc): ?>
                <div class="col-6 col-sm-4 col-lg-4 mt-5">
                    <div class="py-2 px-2 mb-4 d-flex flex-column" style="height: 100%;">
                        <h3 class="card-title text-center mt-2 mb-3 fw-bold"><?= $produc['nama_alat']; ?></h3>
                        <img src="<?= base_url('public/img/produk/' . $produc['foto_produk']); ?>"
                            class="img-fluid border border-dark border-3 rounded-3 card-neoraised"
                            alt="<?= $produc['nama_alat']; ?>">
                        <div class="d-flex justify-content-center mt-3 mb-md-2 gap-3">
                            <a href="<?= base_url('akun/hapusfavorit/' . $produc['id_alat']); ?>"
                                class="btn btn-danger btn-neoraised btn-sm fw-bold">
                                Hapus
                            </a>
                            <a href="<?= base_url('produk/detail/' . $produc['id_alat']); ?>"
                                class="btn btn-primary btn-neoraised btn-sm fw-bold">
                                Periksa
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p class="text-center fs-5">Tidak ada produk didaftar favorit.</p>
        <?php endif; ?>
    </div>
</div>