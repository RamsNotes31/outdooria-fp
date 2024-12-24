<?php

$title = " | Seri Tambah";
include '../../templates/header4.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="javascript:window.history.back()" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card-header">
                    <h3 class="card-title mb-4 text-center fw-bold">Tambah Seri Alat</h3>
                </div>

                <div class="card-body">

                    <form action="tambah_data.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_alat" class="form-label">Nama Alat</label>
                            <select class="form-select card-neoraised" id="nama_alat" name="nama_alat" required>
                                <option value="" selected disabled>Pilih Alat</option>
                                <option value="1">Nama</option>
                                <option value="2">Alat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kondisi</label>
                            <select class="form-select card-neoraised" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kondisi</option>
                                <option value="1">Baru</option>
                                <option value="2">Baik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control card-neoraised" id="jumlah" name="jumlah" min="1" value="1" required>
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