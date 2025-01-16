<?php if (!empty($detail) && isset($detail['id_informasi'])): ?>

    <div class="container mt-5 py-3 px-3">
        <div class="d-flex justify-content-center mb-5 align-items-center">
            <a href="<?= base_url('gunung'); ?>" class="btn btn-outline-info btn-neoraised fw-bold me-3 rounded-pill">Back</a>
            <h1 class="me-3 fw-bolder mt-3">Information</h1>
        </div>
        <div class="row justify-content-center px-3">
            <div class="col-12 col-lg-4 d-flex justify-content-center mb-5">
                <div class="alert alert-danger-neoraised alert-danger text-center fs-5 fw-bold text-wrap" role="alert">
                    <?php
                    $nama = htmlspecialchars($detail['nama_gunung']);
                    if (strlen($nama) > 50) {
                        $nama = wordwrap($nama, 50, "<br>\n");
                    }
                    echo $nama;
                    ?>
                </div>

            </div>
        </div>
        <p class="text-center mt-3 fs-5 fw-bold">
            Lokasi:
            <span class="badge rounded-pill bg-success text-white card-neoraised">
                <?= htmlspecialchars($detail['lokasi']); ?>
            </span>
        </p>
        <div class="col-lg-6 col-12 d-flex justify-content-center text-center offset-lg-3">
            <img src="<?= base_url('public/img/gunung/' . ($detail['foto_gunung'] ?? 'default.jpg')); ?>"
                class="img-fluid border border-dark border-3 rounded-3 card-neoraised"
                alt="<?= htmlspecialchars($detail['nama_gunung'] ?? 'Gunung Tidak Diketahui'); ?>"
                style=" width: 1000px; height: 350px;">
        </div>
        <p class="text-center mt-3 mb-5 fw-bolder justify-content-center">
            Oleh Admin: <br>
            <img src="<?= base_url('public/img/admin/' . ($detail['foto_admin'] ?? 'default.png')); ?>" alt="<?= htmlspecialchars($detail['nama_admin'] ?? 'Admin', ENT_QUOTES, 'UTF-8'); ?>" class="rounded-circle me-2 border border-2 border-dark card-neoraised p-1" width="40" height="40">
            <span class="text-center mt-3 fw-bold">
                <a href="<?= base_url('akun/admin/' . ($detail['nama_admin'] ?? '')); ?>" class="badge rounded-pill card-neoraised bg-primary text-white text-decoration-none"><?= htmlspecialchars($detail['nama_admin'] ?? 'Admin', ENT_QUOTES, 'UTF-8'); ?></a>
            </span>
        </p>

        <div class="row justify-content-center mt-5">
            <div class="col-12 col-lg-6 mb-5 fs-5 mt-5">
                <b>Deskripsi</b>: <br>
                <?= nl2br(htmlspecialchars($detail['deskripsi'])); ?>
                <br><br>
                <b>Harga</b>: <br>
                <span class="badge rounded-pill bg-warning text-dark fs-5 mb-3 mt-3 card-neoraised">
                    Rp. <?= number_format($detail['harga_biaya'], 0, ',', '.'); ?>
                </span>
                <br> Per orang / malam
            </div>

            <div class="col-12 col-lg-6 d-flex justify-content-end mb-5 py-5">
                <div class="card-neoraised border border-dark border-2 rounded-3" style="max-width:100%;list-style:none; transition: none;overflow:hidden;width:800px;height:500px;">
                    <?php
                    $nama_gunung = explode(' ', $detail['nama_gunung']);
                    $nama_gunung = urlencode(implode('+', $nama_gunung));
                    ?>
                    <div id="gmap-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/search?q=<?= $nama_gunung ?>&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div>
                    <style>
                        #gmap-canvas img.text-marker {
                            max-width: none !important;
                            background: none !important;
                        }

                        img {
                            max-width: none
                        }
                    </style>
                </div>
            </div>
        </div>
        <h3 class="text-center mt-5 fw-bold">Other Mountain</h3>
        <div class="row">
            <?php foreach ($gunungs as $info): ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3 px-3 py-3 mx-auto">
                    <div class="card card-neoraised mb-3 py-3 px-3 d-flex flex-column" style="height: 100%;">
                        <div class="row">
                            <div class="col-12">
                                <img
                                    src="<?= base_url('public/img/gunung/' . $info['foto_gunung']); ?>"
                                    class="img-fluid border border-dark border-3 rounded-3 card-neoraised"
                                    alt="<?= htmlspecialchars($info['nama_gunung']); ?>"
                                    style="object-fit: cover; width: 100%; height: 200px;">
                                <p class="text-center mt-3 fw-bold">
                                    Harga Biaya:

                                    <span class="badge rounded-pill card-neoraised bg-primary text-white">
                                        <?= 'Rp. ' . number_format($info['harga_biaya'], 0, ',', '.'); ?>
                                    </span>
                                </p>
                                <div class="row">
                                    <div class="col-12 col-md-9">
                                        <h5 class="card-title mt-3 fw-bolder text-left fs-5">
                                            <?= htmlspecialchars($info['nama_gunung']); ?>
                                        </h5>
                                        <p class="card-text text-left fw-light">
                                            Lokasi: <?= htmlspecialchars($info['lokasi']); ?>
                                        </p>
                                    </div>
                                    <div class="col-12 col-lg-3 d-flex align-items-center justify-content-end ms-auto mt-3">
                                        <a
                                            href="<?= base_url('gunung/info/' . $info['id_informasi']); ?>"
                                            class="btn btn-lg btn-neoraised btn-success text-white fw-bolder">
                                            Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <h1 class="text-center mt-5">Informasi Gunung tidak tersedia.</h1>
    <div class="d-flex justify-content-center mt-5">
        <a href="<?= base_url('gunung'); ?>" class="btn btn-primary btn-neoraised fw-bold">See Avaible Informations</a>
    </div>
<?php endif; ?>