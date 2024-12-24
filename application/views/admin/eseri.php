<?php

$title = " | Seri Update";
include '../../templates/header4.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="javascript:window.history.back()" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card-header">
                    <h3 class="card-title mb-4 text-center fw-bold">Update Seri Alat</h3>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="../../assets/img/gunung.png" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 10rem; height: 10rem;">
                    </div>
                    <form action="tambah_data.php" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kondisi</label>
                            <select class="form-select card-neoraised" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kondisi</option>
                                <option value="1">Baik</option>
                                <option value="2">Minus</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Status</label>
                            <select class="form-select card-neoraised" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="1">Tersedia</option>
                                <option value="2">Dalam Perbaikan</option>
                                <option value="3">Rusak</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold">Ubah</button>
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