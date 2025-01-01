<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php if ($this->session->userdata('nama_admin')) : ?>
            <span class="badge rounded-pill bg-success text-white fs-3 card-neoraised border border-dark border-3 mb-3"><?= $this->session->userdata('nama_admin') ?></span>
        <?php endif; ?>
        <h1 class="h3 mb-0 text-black fw-bolder">Dashboard</h1>
        <a href="<?= base_url("home") ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Go To Website</a>
    </div>

    <div class="row">
        <?php
        $cards = [
            ['title' => 'Total Pendapatan | Bulanan', 'subtitle' => ' | IDR ' . number_format($pendapatan_bulanan ?? 0, 0, ',', '.'), 'value' => 'IDR ' . number_format($total_pendapatan ?? 0, 0, ',', '.'), 'bg' => 'primary', 'icon' => 'bi bi-currency-dollar'],
            ['title' => 'Total Admin', 'subtitle' => '', 'value' => $total_admin ?? 0, 'bg' => 'warning', 'icon' => 'bi bi-person'],
            ['title' => 'Total Penyewaan', 'subtitle' => '', 'value' => $total_penyewaan ?? 0, 'bg' => 'danger', 'icon' => 'bi bi-cart'],
            ['title' => 'Total Users', 'subtitle' => '', 'value' => $total_users ?? 0, 'bg' => 'info', 'icon' => 'bi bi-people'],
            ['title' => 'Total Alat | Stok', 'subtitle' => '', 'value' => ($total_alat ?? 0) . ' | ' . ($total_stok ?? 0), 'bg' => 'primary', 'icon' => 'bi bi-box'],
            ['title' => 'Total Informasi', 'subtitle' => '', 'value' => $total_informasi ?? 0, 'bg' => 'warning', 'icon' => 'bi bi-info-circle'],
            ['title' => 'Total Favorit', 'subtitle' => '', 'value' => $total_favorit ?? 0, 'bg' => 'danger', 'icon' => 'bi bi-heart'],
            ['title' => 'Total Feedback', 'subtitle' => '', 'value' => $total_feedback ?? 0, 'bg' => 'info', 'icon' => 'bi bi-chat'],
        ];
        foreach ($cards as $card): ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-neoraised border border-dark border-3">
                    <div class="card border-left-dark shadow py-2 bg-<?= $card['bg']; ?>  border border-dark border-3">
                        <div class="card-body bg-<?= $card['bg']; ?>">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                        <?= $card['title']; ?>
                                    </div>
                                    <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                        <?= $card['value']; ?><?= $card['subtitle']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-<?= $card['icon']; ?> fa-2x text-light"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card card-neoraised mb-4 border border-dark border-3">
                <div class="card shadow border border-dark border-3 ">
                    <div class="card-header py-3 text-center fw-bold">
                        <h6 class="m-0 fw-bolder text-black fw-bold">Pembelian : <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $perbandingan['total'] ?></span></h6>
                    </div>
                    <div class="card-body">
                        <div class="card-neoraised progress-stacked">
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Segment online" aria-valuenow="<?= $perbandingan['online_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $perbandingan['online_percentage'] ?>%">
                                <div class="progress-bar"></div>
                            </div>
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Segment offline" aria-valuenow="<?= $perbandingan['offline_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $perbandingan['offline_percentage'] ?>%">
                                <div class="progress-bar bg-danger"></div>
                            </div>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2 fw-bolder fw-bold">
                                <i class="bi bi-circle-fill text-primary"></i> Online: <?= $perbandingan['online'] ?> (<?= $perbandingan['online_percentage'] ?>%)
                            </span>
                            <span class="mr-2 fw-bolder fw-bold">
                                <i class="bi bi-circle-fill text-danger"></i> Offline: <?= $perbandingan['offline'] ?> (<?= $perbandingan['offline_percentage'] ?>%)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card card-neoraised mb-4 border border-dark border-3">
                <div class="card shadow border border-dark border-3">
                    <div class="card-header py-3 text-center fw-bold">
                        <h6 class="m-0 fw-bolder text-black fw-bold">
                            Total Users: <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $user_statistics['total_users'] ?></span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="card-neoraised progress-stacked">
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Laki-laki" aria-valuenow="<?= $user_statistics['male_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $user_statistics['male_percentage'] ?>%">
                                <div class="progress-bar bg-info"></div>
                            </div>
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Perempuan" aria-valuenow="<?= $user_statistics['female_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $user_statistics['female_percentage'] ?>%">
                                <div class="progress-bar bg-success"></div>
                            </div>
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Lainnya" aria-valuenow="<?= $user_statistics['other_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $user_statistics['other_percentage'] ?>%">
                                <div class="progress-bar bg-warning"></div>
                            </div>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2 fw-bolder fw-bold">
                                <i class="bi bi-circle-fill text-info"></i> Laki-laki: <?= $user_statistics['total_male'] ?> (<?= $user_statistics['male_percentage'] ?>%)
                            </span>
                            <span class="mr-2 fw-bolder fw-bold">
                                <i class="bi bi-circle-fill text-success"></i> Perempuan: <?= $user_statistics['total_female'] ?> (<?= $user_statistics['female_percentage'] ?>%)
                            </span>
                            <span class="mr-2 fw-bolder fw-bold">
                                <i class="bi bi-circle-fill text-warning"></i> Lainnya: <?= $user_statistics['total_other'] ?> (<?= $user_statistics['other_percentage'] ?>%)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="card card-neoraised mb-4 border border-dark border-3">
                <div class="card shadow border border-dark border-3">
                    <div class="card-header py-3 text-center fw-bold">
                        <h6 class="m-0 fw-bolder text-black fw-bold">
                            Total Admin: <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $admin_statistics['total_admins'] ?></span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="card-neoraised progress-stacked">
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Laki-laki" aria-valuenow="<?= $admin_statistics['male_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $admin_statistics['male_percentage'] ?>%">
                                <div class="progress-bar bg-info"></div>
                            </div>
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Perempuan" aria-valuenow="<?= $admin_statistics['female_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $admin_statistics['female_percentage'] ?>%">
                                <div class="progress-bar bg-success"></div>
                            </div>
                            <div class="progress border border-dark border-3" role="progressbar" aria-label="Lainnya" aria-valuenow="<?= $admin_statistics['other_percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $admin_statistics['other_percentage'] ?>%">
                                <div class="progress-bar bg-warning"></div>
                            </div>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2 fw-bolder">
                                <i class="bi bi-circle-fill text-info"></i> Laki-laki: <?= $admin_statistics['total_male'] ?> (<?= $admin_statistics['male_percentage'] ?>%)
                            </span>
                            <span class="mr-2 fw-bolder">
                                <i class="bi bi-circle-fill text-success"></i> Perempuan: <?= $admin_statistics['total_female'] ?> (<?= $admin_statistics['female_percentage'] ?>%)
                            </span>
                            <span class="mr-2 fw-bolder">
                                <i class="bi bi-circle-fill text-warning"></i> Lainnya: <?= $admin_statistics['total_other'] ?> (<?= $admin_statistics['other_percentage'] ?>%)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="card card-neoraised mb-3 border border-dark border-3">
                    <div class="card shadow border border-dark border-3">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-center justify-content-center">
                                <h1 class="h3 mb-0 fw-bolder mb-4">Menunggu Konfirmasi (<?= count($rentals) ?>)</h1>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable1" class="display table table-borderless card-neoraised border border-dark border-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Nama User</th>
                                            <th class="text-center">Nama Alat</th>
                                            <th class="text-center">Seri Alat</th>
                                            <th class="text-center">Tanggal Sewa</th>
                                            <th class="text-center">Tanggal Kembali</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Bukti Pembayaran</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rentals as $rental): ?>
                                            <tr>
                                                <td class="text-center">#<?= $rental['id_penyewaan'] ?></td>
                                                <td class="text-center"><?= $rental['nama_user'] ?></td>
                                                <td class="text-center"><?= $rental['nama_alat'] ?></td>
                                                <td class="text-center"><?= $rental['seri_alat'] ?></td>
                                                <td class="text-center"><?= $rental['tanggal_penyewaan'] ?></td>
                                                <td class="text-center"><?= $rental['tanggal_pengembalian'] ?></td>
                                                <td class="text-center"><?= 'Rp ' . number_format($rental['total_harga'], 0, ',', '.') ?></td>
                                                <td class="text-center"><?= $rental['status_sewa'] ?></td>
                                                <td class="text-center">
                                                    <?php if ($rental['bukti_pembayaran'] == null) { ?>
                                                        <span class="badge rounded-pill bg-success text-black fs-6 card-neoraised border border-dark">Bayar Ditempat</span>
                                                    <?php } else { ?>
                                                        <?php if (file_exists(FCPATH . 'public/img/bukti/' . $rental['bukti_pembayaran'])): ?>
                                                            <img src="<?= base_url('public/img/bukti/' . $rental['bukti_pembayaran']) ?>" alt="Bukti Pembayaran" width="250" height="250" class="rounded-3 border border-dark card-neoraised img-fluid">
                                                        <?php else: ?>
                                                            <p>Gambar tidak tersedia.</p>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="d-flex justify-content-center gap-3 text-center">
                                                    <a href="<?= base_url('dashboard/accept/' . $rental['id_penyewaan']) ?>" class="btn btn-warning btn-sm fw-bold border border-dark btn-neoraised">Accept</a>
                                                    <a href="<?= base_url('dashboard/reject/' . $rental['id_penyewaan']) ?>" class="btn btn-danger btn-sm fw-bold border border-dark btn-neoraised">Reject</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Nama User</th>
                                            <th class="text-center">Nama Alat</th>
                                            <th class="text-center">Seri Alat</th>
                                            <th class="text-center">Tanggal Sewa</th>
                                            <th class="text-center">Tanggal Kembali</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Bukti Pembayaran</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="card card-neoraised mb-3 border border-dark border-3">
                    <div class="card shadow border border-dark border-3">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-center justify-content-center">
                                <h1 class="h3 mb-0 fw-bolder mb-4">Sedang Disewa (<?= count($rentalss) ?>)</h1>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable2" class="display table table-borderless card-neoraised border border-dark border-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Nama User</th>
                                            <th class="text-center">Nama Alat</th>
                                            <th class="text-center">Seri Alat</th>
                                            <th class="text-center">Tanggal Kembali</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rentalss as $rent): ?>
                                            <tr>
                                                <td class="text-center"><?php if (isset($rent['id_penyewaan'])) echo '#' . $rent['id_penyewaan']; ?></td>
                                                <td class="text-center"><?php if (isset($rent['nama_user'])) echo $rent['nama_user']; ?></td>
                                                <td class="text-center"><?php if (isset($rent['nama_alat'])) echo $rent['nama_alat']; ?></td>
                                                <td class="text-center"><?php if (isset($rent['seri_alat'])) echo $rent['seri_alat']; ?></td>
                                                <td class="text-center"><?php if (isset($rent['tanggal_pengembalian'])) echo $rent['tanggal_pengembalian']; ?></td>
                                                <td class="text-center"><?php if (isset($rent['status_sewa'])) echo $rent['status_sewa']; ?></td>

                                                <td class="d-flex justify-content-center gap-3 text-center">
                                                    <?php if (isset($rent['id_penyewaan'])): ?>
                                                        <a href="<?= base_url('dashboard/complete/' . $rent['id_penyewaan']) ?>" class="btn btn-success btn-sm fw-bold border border-dark btn-neoraised">Finished</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Nama User</th>
                                            <th class="text-center">Nama Alat</th>
                                            <th class="text-center">Seri Alat</th>
                                            <th class="text-center">Tanggal Kembali</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#datatable1').DataTable();
            $('#datatable2').DataTable();
        });
    </script>

    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6">
            <div class="card card-neoraised mb-3 border border-dark border-3">
                <div class="card shadow border border-dark border-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bolder text-black">
                            Total Stok:
                            <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $total_stok ?></span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small fw-bolder">Rusak (<?= $rusak ?>)
                            <span class="float-right"><?= round($percentagess['rusak'], 2) ?>%</span>
                        </h4>
                        <div class="progress mb-4 card-neoraised">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger border border-dark border-3" role="progressbar"
                                style="width: <?= $percentagess['rusak'] ?>%"
                                aria-valuenow="<?= $percentagess['rusak'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small fw-bolder">Dalam Perawatan (<?= $dalam_perawatan ?>)
                            <span class="float-right"><?= round($percentagess['dalam_perawatan'], 2) ?>%</span>
                        </h4>
                        <div class="progress mb-4 card-neoraised">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning border border-dark border-3" role="progressbar"
                                style="width: <?= $percentagess['dalam_perawatan'] ?>%"
                                aria-valuenow="<?= $percentagess['dalam_perawatan'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small fw-bolder">Disewa (<?= $disewa ?>)
                            <span class="float-right"><?= round($percentagess['disewa'], 2) ?>%</span>
                        </h4>
                        <div class="progress mb-4 card-neoraised">
                            <div class="progress-bar progress-bar-striped progress-bar-animated border border-dark border-3" role="progressbar"
                                style="width: <?= $percentagess['disewa'] ?>%"
                                aria-valuenow="<?= $percentagess['disewa'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small fw-bolder">Tersedia (<?= $tersedia ?>)
                            <span class="float-right"><?= round($percentagess['tersedia'], 2) ?>%</span>
                        </h4>
                        <div class="progress card-neoraised mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success border border-dark border-3" role="progressbar"
                                style="width: <?= $percentagess['tersedia'] ?>%"
                                aria-valuenow="<?= $percentagess['tersedia'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-6 col-lg-6">
            <div class="card card-neoraised mb-3 border border-3 border-dark">
                <div class="card shadow border border-3 border-dark">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bolder text-black">
                            Total Penyewaan:
                            <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $total_penyewaan ?></span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small fw-bolder">Batal (<?= $batal ?>)
                            <span class="float-right"><?= round($percentages['batal'], 2) ?>%</span>
                        </h4>
                        <div class="progress mb-4 card-neoraised">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger border border-dark border-3" role="progressbar"
                                style="width: <?= $percentages['batal'] ?>%"
                                aria-valuenow="<?= $percentages['batal'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small fw-bolder">Menunggu (<?= $menunggu ?>)
                            <span class="float-right"><?= round($percentages['menunggu'], 2) ?>%</span>
                        </h4>
                        <div class="progress mb-4 card-neoraised">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning border border-dark border-3" role="progressbar"
                                style="width: <?= $percentages['menunggu'] ?>%"
                                aria-valuenow="<?= $percentages['menunggu'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small fw-bolder">Disewa (<?= $disewa ?>)
                            <span class="float-right"><?= round($percentages['disewa'], 2) ?>%</span>
                        </h4>
                        <div class="progress mb-4 card-neoraised">
                            <div class="progress-bar progress-bar-striped progress-bar-animated border border-dark border-3" role="progressbar"
                                style="width: <?= $percentages['disewa'] ?>%"
                                aria-valuenow="<?= $percentages['disewa'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small fw-bolder">Selesai (<?= $selesai ?>)
                            <span class="float-right"><?= round($percentages['selesai'], 2) ?>%</span>
                        </h4>
                        <div class="progress card-neoraised mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success border border-dark border-3" role="progressbar"
                                style="width: <?= $percentages['selesai'] ?>%"
                                aria-valuenow="<?= $percentages['selesai'] ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row mb-3">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-neoraised border border-dark border-3">
                <div class="card border-left-dark shadow py-2 bg-success border border-dark border-3">
                    <div class="card-body bg-success">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                    Alat Terlaris
                                </div>
                                <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                    <?php if (isset($alat_terlaris[0]['nama_alat'])) {
                                        echo $alat_terlaris[0]['nama_alat'];
                                    } ?><br><br>(<?= $alat_terlaris[0]['total_rented'] ?? 0 ?>x) Disewa
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-trophy fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-neoraised border border-dark border-3">
                <div class="card border-left-dark shadow py-2 bg-warning border border-dark border-3">
                    <div class="card-body bg-warning">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                    Rating Terbaik
                                </div>
                                <div class="h5 mb-0 fw-bolder text-black fw-bold"> <?php
                                                                                    if (isset($rating_tertinggi[0]->nama_alat)) {
                                                                                        echo $rating_tertinggi[0]->nama_alat;
                                                                                    }
                                                                                    ?><br><br>
                                    <?php
                                    if (isset($rating_tertinggi[0]->average_rating)) {
                                        $rating = $rating_tertinggi[0]->average_rating;
                                        $hasHalfStar = ($rating - floor($rating)) >= 0.5;
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= floor($rating)) {
                                                echo '<i class="bi bi-star-fill text-black"></i>';
                                            } elseif ($hasHalfStar && $i == floor($rating) + 1) {
                                                echo '<i class="bi bi-star-half text-black"></i>';
                                                $hasHalfStar = false;
                                            } else {
                                                echo '<i class="bi bi-star text-black"></i>';
                                            }
                                        }
                                    }
                                    ?> (<?php if (isset($rating)) echo number_format((float)$rating, 1, '.', ''); ?>)
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-star-fill fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-neoraised border border-dark border-3">
                <div class="card border-left-dark shadow py-2 bg-primary border border-dark border-3">
                    <div class="card-body bg-primary">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                    Top Favorit
                                </div>
                                <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                    <?php
                                    if (isset($top_favorit) && isset($top_favorit[0]->nama_alat)) {
                                        echo $top_favorit[0]->nama_alat;
                                    }
                                    ?><br><br> (<?php if (isset($top_favorit) && isset($top_favorit[0]->total_favorites)) echo $top_favorit[0]->total_favorites ?? 0; ?>x) Favorit
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-heart-fill fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-neoraised border border-dark border-3">
                <div class="card border-left-dark shadow py-2 bg-success border border-dark border-3">
                    <div class="card-body bg-success">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                    Top Admin Post
                                </div>
                                <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                    <?php if (isset($top_admin_posting['nama_admin'])) echo $top_admin_posting['nama_admin']; ?> <br><br> (<?php if (isset($top_admin_posting['total_posting'])) echo $top_admin_posting['total_posting']; ?>x) Posting
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-badge fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-neoraised border border-dark border-3">
                <div class="card border-left-dark shadow py-2 bg-warning border border-dark border-3">
                    <div class="card-body bg-warning">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                    Stok Terbanyak
                                </div>
                                <div class="h5 mb-0 fw-bolder text-black fw-bold"><?php
                                                                                    if (isset($stok_terbanyak[0]->nama_alat)) {
                                                                                        echo $stok_terbanyak[0]->nama_alat;
                                                                                    }
                                                                                    ?><br><br>
                                    (<?php
                                        if (isset($stok_terbanyak[0]->stok)) {
                                            echo $stok_terbanyak[0]->stok;
                                        }
                                        ?>) Stok
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-box-seam fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-neoraised border border-dark border-3">
                <div class="card border-left-dark shadow py-2 bg-primary border border-dark border-3">
                    <div class="card-body bg-primary">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                    Top User Sewa
                                </div>
                                <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                    <?php if (isset($top_user_rented_item['nama_user'])) {
                                        echo $top_user_rented_item['nama_user'];
                                    } ?> <br><br> <?php if (isset($top_user_rented_item['nama_alat'])) {
                                                        echo $top_user_rented_item['nama_alat'];
                                                    } ?> (<?php if (isset($top_user_rented_item['jumlah_disewa'])) {
                                                                echo $top_user_rented_item['jumlah_disewa'];
                                                            } ?>x)
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people-fill fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card card-neoraised border border-dark border-3">
                    <div class="card border-left-dark shadow py-2 bg-secondary  border border-dark border-3">
                        <div class="card-body bg-secondary">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                        Top User Feedback
                                    </div>
                                    <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                        <?= isset($top_user_feedback['user_name']) ? $top_user_feedback['user_name'] : 'N/A'; ?> <br><br>(<?= isset($top_user_feedback['total_feedback']) ? $top_user_feedback['total_feedback'] : '0'; ?>) Reviews |
                                        <?php
                                        $fullStars = isset($top_user_feedback['average_rating']) ? floor((float)$top_user_feedback['average_rating']) : 0;
                                        $halfStar = isset($top_user_feedback['average_rating']) && $top_user_feedback['average_rating'] - $fullStars >= 0.5;
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($i < $fullStars) {
                                                echo '<i class="bi bi-star-fill text-warning"></i>';
                                            } elseif ($halfStar && $i == $fullStars) {
                                                echo '<i class="bi bi-star-half text-warning"></i>';
                                            } else {
                                                echo '<i class="bi bi-star text-warning"></i>';
                                            }
                                        }
                                        ?> (<?= isset($top_user_feedback['average_rating']) ? number_format((float)$top_user_feedback['average_rating'], 1) : 'N/A'; ?>)
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-chat-square-text fa-2x text-light"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card card-neoraised border border-dark border-3">
                    <div class="card border-left-dark shadow py-2 bg-secondary  border border-dark border-3">
                        <div class="card-body bg-secondary">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                        Top Admin Chat
                                    </div>
                                    <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                        <?= isset($top_admin_chat['nama_admin']) ? $top_admin_chat['nama_admin'] : 'N/A'; ?> <br><br> (<?= isset($top_admin_chat['total_replies']) ? $top_admin_chat['total_replies'] : '0'; ?>) Pesan Chat Dibalas
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-headset fa-2x text-light"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="card card-neoraised mb-3 border border-dark border-3">
                    <div class="card shadow border border-dark border-3">
                        <div class="card-header py-5">
                            <h6 class="m-0 fw-bolder text-black">Total Barang :
                                <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $total_stok; ?></span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small fw-bolder">Minus (<?= $minus ?>) <span class="float-right"><?= round($percentagesss['minus'], 2); ?>%</span></h4>
                            <div class="progress mb-4 card-neoraised">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger border border-dark border-3" role="progressbar"
                                    style="width: <?= $percentagesss['minus']; ?>%"
                                    aria-valuenow="<?= $percentagesss['minus']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <h4 class="small fw-bolder">Baik (<?= $baik ?>) <span class="float-right"><?= round($percentagesss['baik'], 2); ?>%</span></h4>
                            <div class="progress mb-4 card-neoraised">
                                <div class="progress-bar progress-bar-striped progress-bar-animated border border-dark border-3" role="progressbar"
                                    style="width: <?= $percentagesss['baik']; ?>%"
                                    aria-valuenow="<?= $percentagesss['baik']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <h4 class="small fw-bolder">Baru (<?= $baru ?>) <span class="float-right"><?= round($percentagesss['baru'], 2); ?>%</span></h4>
                            <div class="progress card-neoraised mb-4">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success border border-dark border-3" role="progressbar"
                                    style="width: <?= $percentagesss['baru']; ?>%"
                                    aria-valuenow="<?= $percentagesss['baru']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card card-neoraised mb-3 border border-dark border-3">
                    <div class="card shadow border border-dark border-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 fw-bolder text-black">Total Alat :
                                <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= $total_alat; ?></span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $colors = [
                                'bg-primary',
                                'bg-info',
                                'bg-success',
                                'bg-warning',
                            ];
                            ?>

                            <?php
                            $kategori_counts = $kategori ?? [
                                (object)['kategori' => 'primary', 'total' => 0],
                                (object)['kategori' => 'secondary', 'total' => 0],
                                (object)['kategori' => 'accessory', 'total' => 0],
                                (object)['kategori' => 'others', 'total' => 0],
                            ];
                            foreach ($kategori_counts as $i => $kategori): ?>
                                <h4 class="small fw-bolder"><?= ucfirst($kategori->kategori) ?> (<?= $kategori->total ?>)
                                    <span class="float-right"><?= $total_alat > 0 ? round(($kategori->total / $total_alat) * 100, 2) : 0; ?>%</span>
                                </h4>
                                <div class="progress mb-4 card-neoraised">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated border border-dark border-3 <?= $colors[$i % count($colors)]; ?>" role="progressbar"
                                        style="width: <?= $total_alat > 0 ? ($kategori->total / $total_alat) * 100 : 0; ?>%" aria-valuenow="<?= $total_alat > 0 ? ($kategori->total / $total_alat) * 100 : 0; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <!-- Bukti Pembayaran -->
                    <div class="col-12 col-md-12">
                        <div class="card card-neoraised mb-3 border border-dark border-3">
                            <div class="card-header py-3 border border-dark border-3">
                                <h6 class="m-0 fw-bolder text-black text-center">Bukti Pembayaran
                                    <span class="badge card-neoraised bg-secondary text-light border border-dark border-3"><?= count($bukti_pembayaranya); ?></span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="splide" role="group" aria-label="Bukti Pembayaran Slider">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <?php foreach ($bukti_pembayaranya as $bukti) : ?>
                                                <li class="splide__slide d-flex align-items-center justify-content-center">
                                                <?php if (empty($bukti['bukti_pembayaran'])): ?>
                                                    <p class="text-center">Tidak ada bukti pembayaran.</p>
                                                <?php endif; ?>
                                                    <?php if (!empty($bukti['bukti_pembayaran'])): ?>
                                                        <?php if (file_exists(FCPATH . 'public/img/bukti/' . $bukti['bukti_pembayaran'])): ?>
                                                            <img src="<?= base_url('public/img/bukti/' . $bukti['bukti_pembayaran']); ?>" alt="Slide" class="img-fluid mb-5 card-neoraised border border-dark border-3" style="max-width: 100%;">
                                                        <?php else: ?>
                                                            <p>Gambar tidak tersedia.</p>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <p class="text-center">Tidak ada bukti pembayaran.</p>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    new Splide(".splide", {
                        type: "fade",
                        rewind: true,
                    }).mount();

                });
            </script>

        </div>
    </div>
</div>