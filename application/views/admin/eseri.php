<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="<?= base_url('admin/data_seri_alat') ?>" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold border border-dark border-3">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card-header card card-neoraised border border-3 border-dark">
                    <h3 class="card-title mb-4 text-center fw-bold mt-4 text-black rounded-3">Update Seri Alat</h3>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('admin/update_seri_alat/' . $product['seri_alat']) ?>" method="post">
                        <input type="hidden" name="id" value="<?= $product['seri_alat'] ?>">

                        <div class="mb-3">
                            <label for="nama_alat" class="form-label text-black">Nama Alat</label>
                            <input type="text" class="form-control card-neoraised" id="nama_alat" name="nama_alat"
                                value="<?= isset($produk['nama_alat']) ? $produk['nama_alat'] : '' ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label text-black">Kondisi</label>
                            <select class="form-select card-neoraised" id="kondisi" name="kondisi" required>
                                <option value="" selected disabled>Pilih Kondisi</option>
                                <?php foreach ($kondisi as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= $key == $product['kondisi'] ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label text-black">Status</label>
                            <select class="form-select card-neoraised" id="status" name="status" required>
                                <option value="" selected disabled>Pilih Status</option>
                                <?php foreach ($status as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= $key == $product['status_produk'] ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold border border-3 border-dark">Ubah</button>
                            <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold border border-3 border-dark">Reset</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
</div>