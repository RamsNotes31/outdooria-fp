<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Seri Alat</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <div class="d-flex justify-content-center mb-3">
            <a href="<?= base_url('admin/tambah_seri_alat') ?>" class="btn btn-warning btn-neoraised btn-md fw-bold border border-dark border-3">Tambah Stok</a>
        </div>

        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Seri Alat</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Kondisi</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Tanggal Tambah</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($series as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $row->seri_alat ?></td>
                        <td class="text-center"><?= $row->nama_alat ?></td>
                        <td class="text-center"><?= $row->kondisi ?></td>
                        <td class="text-center"><?= $row->status_produk ?></td>
                        <td class="text-center"><?= date('Y-m-d', strtotime($row->tanggal_ditambahkan)) ?></td>
                        <td class="text-center d-flex justify-content-center gap-3">
                            <?php if ($row->status_produk === 'menunggu') : ?>
                                <span class="fw-bold">Barang Ingin Disewa</span>
                            <?php elseif ($row->status_produk === 'disewa') : ?>
                                <span class="fw-bold">Barang Sedang Disewa</span>
                            <?php else : ?>
                                <?php if ($row->status_produk !== 'menunggu' && $row->status_produk !== 'disewa') : ?>
                                    <a href="<?= base_url('admin/ubah_seri/' . $row->seri_alat) ?>" class="btn btn-primary btn-sm btn-neoraised fw-bold border border-dark border-3">Edit</a>
                                    <a href="<?= base_url('admin/hapus_seri/' . $row->seri_alat) ?>" class="btn btn-danger btn-sm btn-neoraised fw-bold border border-dark border-3" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Seri Alat</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Kondisi</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Tanggal Tambah</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>