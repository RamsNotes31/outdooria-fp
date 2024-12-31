<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold border border-dark border-3">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card-header card card-neoraised border border-3 border-dark rounded-3">
                    <h3 class="card-title mb-4 text-center fw-bold mt-4 text-black">Tambah Seri Alat</h3>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('admin/tambah_data_seri') ?>" method="post">
                        <div class="mb-3">
                            <label for="nama_alat" class="form-label text-black">Nama Alat</label>
                            <select class="form-select card-neoraised" id="nama_alat" name="nama_alat" required>
                                <option value="" selected disabled>Pilih Alat</option>
                                <?php foreach ($nama_alat as $alat): ?>
                                    <option value="<?= $alat->id_alat ?>"><?= $alat->id_alat ?> | <?= $alat->nama_alat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label text-black">Kondisi</label>
                            <select class="form-select card-neoraised" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kondisi</option>
                                <?php foreach ($kondisi as $k): ?>
                                    <option value="<?= $k ?>"><?= $k ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label text-black">Status</label>
                            <select class="form-select card-neoraised" id="status" name="status" required>
                                <option value="" selected disabled>Pilih Status</option>
                                <?php foreach ($status as $s): ?>
                                    <option value="<?= $s ?>"><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label text-black">Jumlah</label>
                            <input type="number" class="form-control card-neoraised " id="jumlah" name="jumlah" min="1" value="1" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold border border-2 border-dark">Ubah</button>
                            <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold border border-2 border-dark">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>