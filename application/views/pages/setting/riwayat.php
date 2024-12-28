<div class="container mt-5 py-5">
    <h1 class="text-center fw-bolder mb-5">Riwayat Penyewaan</h1>
    <div class="table-responsive">
        <table id="datatable1" class="table table-hover table-borderless card-neoraised border border-dark border-3 w-100">
            <thead>
                <tr>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Seri Alat</th>
                    <th class="text-center">Tanggal Sewa</th>
                    <th class="text-center">Tanggal Kembali</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Bukti Bayar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($riwayat)): ?>
                    <?php foreach ($riwayat as $item): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($item->nama_alat); ?></td>
                            <td class="text-center"><?= htmlspecialchars($item->seri_alat); ?></td>
                            <td class="text-center"><?= htmlspecialchars($item->tanggal_penyewaan); ?></td>
                            <td class="text-center"><?= htmlspecialchars($item->tanggal_pengembalian); ?></td>
                            <td class="text-center">Rp <?= number_format($item->total_harga, 0, ',', '.'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($item->status_sewa); ?></td>
                            <td class="text-center">
                                <?php if (!empty($item->bukti_pembayaran) && $item->status_sewa !== 'batal' ): ?>
                                    <img src="<?= base_url('public/img/bukti/' . $item->bukti_pembayaran); ?>" width="100" height="100" class="img-thumbnail card-neoraised border border-dark border-2" alt="Bukti Bayar">
                                <?php else: ?>
                                    <?php if ($item->status_sewa === 'menunggu'): ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php elseif ($item->status_sewa === 'batal'): ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php elseif ($item->status_sewa === 'disewa' || $item->status_sewa === 'selesai'): ?>
                                        <span class="text-muted">Bayar ditempat</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('invoice/kode/' . $item->id_penyewaan); ?>" class="btn btn-sm btn-primary btn-neoraised fw-bold rounded-2">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Seri Alat</th>
                    <th class="text-center">Tanggal Sewa</th>
                    <th class="text-center">Tanggal Kembali</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Bukti Bayar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>