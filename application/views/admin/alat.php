<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Alat</h1>
        <a href="<?= base_url('dashboard'); ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <div class="d-flex justify-content-center mb-3">
            <a href="<?= base_url('admin/talat'); ?>" class="btn btn-warning btn-neoraised btn-md fw-bold border border-2 border-dark">Tambah Alat</a>
        </div>
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Alat</th>
                    <th class="text-center">Foto Alat</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Harga Sewa</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alat as $alat) : ?>
                    <tr>
                        <td class="text-center"><?= $alat->id_alat ?></td>
                        <td class="text-center">
                            <?php if (file_exists('./public/img/produk/' . $alat->foto_produk)) : ?>
                                <img src="<?= base_url('public/img/produk/' . $alat->foto_produk) ?>" alt="<?= $alat->nama_alat ?>" width="250" height="150" class=" border border-dark card-neoraised">
                            <?php else : ?>
                                <img src="<?= base_url('public/img/produk/default.jpg') ?>" alt="No Image" width="150" height="150" class="rounded-circle border border-dark card-neoraised">
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= $alat->nama_alat ?></td>
                        <td class="text-center"><?= $alat->kategori ?></td>
                        <td class="text-center"><?= $alat->stok ?></td>
                        <td class="text-center">Rp <?= number_format($alat->harga_sewa, 0, ',', '.') ?></td>
                        <td class="text-center"><?= $alat->deskripsi ?></td>
                        <td class="text-center d-flex justify-content-center gap-3">
                            <a href="<?= base_url('admin/ealat/' . $alat->id_alat) ?>" class="btn btn-primary btn-sm btn-neoraised fw-bold border border-dark border-3">Edit</a>
                            <a href="<?= base_url('admin/dalat/' . $alat->id_alat) ?>" class="btn btn-danger btn-sm btn-neoraised fw-bold border border-dark border-3" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Alat</th>
                    <th class="text-center">Foto Alat</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Harga Sewa</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>