<div class="container-fluid py-5 px-3">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Penyewaan</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dashboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Penyewaan</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Seri Alat</th>
                    <th class="text-center">Tanggal Sewa</th>
                    <th class="text-center">Tanggal Kembali</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penyewaans as $item): ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($item->id_penyewaan, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($item->nama_user, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($item->nama_alat, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($item->seri_alat, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($item->tanggal_penyewaan, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($item->tanggal_pengembalian, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center">Rp <?= number_format($item->total_harga, 0, ',', '.'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($item->status_sewa, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="text-center">
                            <?php if (!empty($item->bukti_pembayaran) && $item->status_sewa !== 'batal'): ?>
                                <?php if (file_exists(FCPATH . 'public/img/bukti/' . $item->bukti_pembayaran)): ?>
                                    <img src="<?= base_url('public/img/bukti/' . $item->bukti_pembayaran); ?>" width="100" height="100" class="img-thumbnail card-neoraised border border-dark border-2" alt="Bukti Bayar">
                                <?php else: ?>
                                    <p class="card-text text-muted card card-neoraised p-1">Foto Telah dihapus.</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted">
                                    <?php if ($item->status_sewa === 'menunggu'): ?>
                                        Tidak ada
                                    <?php elseif ($item->status_sewa === 'batal'): ?>
                                        Tidak ada
                                    <?php elseif (in_array($item->status_sewa, ['disewa', 'selesai'])): ?>
                                        Bayar ditempat
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Penyewaan</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Seri Alat</th>
                    <th class="text-center">Tanggal Sewa</th>
                    <th class="text-center">Tanggal Kembali</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Bukti Pembayaran</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>