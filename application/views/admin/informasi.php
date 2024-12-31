<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Informasi</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <div class="d-flex justify-content-center mb-3">
            <a href="<?= base_url('admin/tinformasi') ?>" class="btn btn-warning btn-neoraised btn-md fw-bold border border-dark border-3">Tambah Informasi</a>
        </div>

        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Informasi</th>
                    <th class="text-center">Foto Gunung</th>
                    <th class="text-center">Nama Gunung</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Harga Biaya</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tanggal Update</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($info as $info) : ?>
                    <tr>
                        <td class="text-center"><?= $info->id_informasi ?></td>
                        <td class="text-center">
                            <?php if (file_exists('./public/img/gunung/' . $info->foto_gunung)) : ?>
                                <img src="<?= base_url('public/img/gunung/' . $info->foto_gunung) ?>" alt="<?= $info->nama_gunung ?>" width="150" height="150" class="rounded-3 border border-dark card-neoraised">
                            <?php else : ?>
                                <img src="<?= base_url('public/img/gunung/default.jpg') ?>" alt="No Image" width="150" height="150" class="rounded-3 border border-dark card-neoraised">
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= $info->nama_gunung ?></td>
                        <td class="text-center"><?= $info->lokasi ?></td>
                        <td class="text-center">Rp <?= number_format($info->harga_biaya, 0, ',', '.') ?></td>
                        <td class="text-center"><?= $info->deskripsi ?></td>
                        <td class="text-center"><?= $info->tanggal_update ?></td>
                        <td class="text-center d-flex justify-content-center gap-3">
                            <a href="<?= base_url('admin/einformasi/' . $info->id_informasi) ?>" class="btn btn-primary btn-sm btn-neoraised fw-bold border border-dark border-3">Edit</a>
                            <a href="<?= base_url('admin/dinformasi/' . $info->id_informasi) ?>" class="btn btn-danger btn-sm btn-neoraised fw-bold border border-dark border-3" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Informasi</th>
                    <th class="text-center">Foto Gunung</th>
                    <th class="text-center">Nama Gunung</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Harga Biaya</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tanggal Update</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>
