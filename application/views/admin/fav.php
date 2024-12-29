<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Favorit</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">

        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Favorit</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Tanggal Tambah</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($favorites)): ?>
                    <?php foreach ($favorites as $fav): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($fav->id_favorit, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($fav->nama_user, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($fav->nama_alat, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="text-center"><?= htmlspecialchars($fav->tanggal_ditambahkan, ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data favorit tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Favorit</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Tanggal Tambah</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>