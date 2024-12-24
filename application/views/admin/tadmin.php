<?php

$title = " | Admin Tambah";
include '../../templates/header4.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="javascript:window.history.back()" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card-header">
                    <h3 class="card-title mb-4 text-center fw-bold">Tambah Data Admin</h3>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="../../assets/img/gunung.png" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 10rem; height: 10rem;">
                    </div>
                    <form action="ubah_data.php" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control card-neoraised" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control card-neoraised" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control card-neoraised" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control card-neoraised" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control card-neoraised" id="alamat" name="alamat" rows="4" style="resize: none;" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profile</label>
                            <input type="file" class="form-control card-neoraised" id="foto" name="foto" accept="image/*" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold">Tambah</button>
                            <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include '../../templates/footer.php'; ?>