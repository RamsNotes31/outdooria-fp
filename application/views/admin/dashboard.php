<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-black fw-bolder">Dashboard</h1>
        <a href="<?= base_url("home") ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Go To Website</a>
    </div>

    <div class="row">
        <?php
        $cards = [
            ['title' => 'Total Pendapatan', 'value' => 'IDR ' . number_format((float)$total_pendapatan, 0, ',', '.'), 'bg' => 'primary', 'icon' => 'bi bi-currency-dollar'],
            ['title' => 'Total Admin', 'value' => $total_admin, 'bg' => 'warning', 'icon' => 'bi bi-person'],
            ['title' => 'Total Penyewaan', 'value' => $total_penyewaan, 'bg' => 'danger', 'icon' => 'bi bi-cart'],
            ['title' => 'Total Users', 'value' => $total_users, 'bg' => 'info', 'icon' => 'bi bi-people'],
            ['title' => 'Total Alat | Stok', 'value' => $total_alat . ' | ' . $total_stok, 'bg' => 'primary', 'icon' => 'bi bi-box'],
            ['title' => 'Total Informasi', 'value' => $total_informasi, 'bg' => 'warning', 'icon' => 'bi bi-info-circle'],
            ['title' => 'Total Favorit', 'value' => $total_favorit, 'bg' => 'danger', 'icon' => 'bi bi-heart'],
            ['title' => 'Total Feedback', 'value' => $total_feedback, 'bg' => 'info', 'icon' => 'bi bi-chat'],
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
                                        <?= $card['value']; ?>
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
                                <i class="bi bi-circle-fill text-primary"></i> Online: <?= $perbandingan['online'] ?>
                            </span>
                            <span class="mr-2 fw-bolder fw-bold">
                                <i class="bi bi-circle-fill text-danger"></i> Offline: <?= $perbandingan['offline'] ?>
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
                                <h1 class="h3 mb-0 fw-bolder mb-4">Menunggu Konfirmasi</h1>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable1" class="display table table-borderless card-neoraised border border-dark border-3" style="width:100%">
                                    <thead>
                                        <tr>
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
                                                        <img src="<?= base_url('public/img/bukti/' . $rental['bukti_pembayaran']) ?>" alt="Bukti Pembayaran" width="50" height="50" class="rounded-3 border border-dark card-neoraised img-fluid">
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
                                <h1 class="h3 mb-0 fw-bolder mb-4">Sedang Disewa</h1>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable2" class="display table table-borderless card-neoraised border border-dark border-3" style="width:100%">
                                    <thead>
                                        <tr>
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
                                                <td class="text-center"><?= $rent['nama_user'] ?></td>
                                                <td class="text-center"><?= $rent['nama_alat'] ?></td>
                                                <td class="text-center"><?= $rent['seri_alat'] ?></td>
                                                <td class="text-center"><?= $rent['tanggal_pengembalian'] ?></td>
                                                <td class="text-center"><?= $rent['status_sewa'] ?></td>

                                                <td class="d-flex justify-content-center gap-3 text-center">
                                                    <a href="<?= base_url('dashboard/complete/' . $rent['id_penyewaan']) ?>" class="btn btn-success btn-sm fw-bold border border-dark btn-neoraised">Finished</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
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
        <?php
        $cardss = [
            ['title' => 'Alat Terlaris', 'value' => $alat_terlaris, 'bg' => 'success', 'icon' => 'bi-trophy'],
            ['title' => 'Rating Terbaik', 'value' => $rating_tertinggi, 'bg' => 'warning', 'icon' => 'bi-star-fill'],
            ['title' => 'Top Favorit', 'value' => $top_favorit, 'bg' => 'primary', 'icon' => 'bi-heart-fill'],
            ['title' => 'Top Admin', 'value' => $top_admin, 'bg' => 'success', 'icon' => 'bi-person-badge'],
            ['title' => 'Stok Terbanyak', 'value' => $stok_terbanyak, 'bg' => 'warning', 'icon' => 'bi-box-seam'],
            ['title' => 'Top User', 'value' => $top_user, 'bg' => 'primary', 'icon' => 'bi-people-fill'],
        ];

        foreach ($cardss as $carda):
            $value = (is_array($carda['value']) && !empty($carda['value'])) ? $carda['value'][0] : null;
        ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card card-neoraised border border-dark border-3">
                    <div class="card border-left-dark shadow py-2 bg-<?= $carda['bg']; ?> border border-dark border-3">
                        <div class="card-body bg-<?= $carda['bg']; ?>">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg fw-bolder text-light text-uppercase mb-1 fw-bold">
                                        <?= $carda['title']; ?>
                                    </div>
                                    <div class="h5 mb-0 fw-bolder text-black fw-bold">
                                        <?php
                                        if ($value) {
                                            if (isset($value->nama_admin)) {
                                                echo $value->nama_admin;
                                            } elseif (isset($value->nama_alat)) {
                                                echo $value->nama_alat;
                                            } elseif (isset($value->average_rating)) {
                                                echo number_format($value->average_rating, 2);
                                            } elseif (isset($value->nama)) {
                                                echo $value->nama;
                                            } elseif (isset($value->stok)) {
                                                echo $value->stok;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi <?= $carda['icon']; ?> fa-2x text-light"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
                        <?php foreach ($kategori_counts as $i => $kategori): ?>
                            <h4 class="small fw-bolder"><?= ucfirst($kategori->kategori) ?> (<?= $kategori->total ?>)
                                <span class="float-right"><?= round(($kategori->total / $total_alat) * 100, 2); ?>%</span>
                            </h4>
                            <div class="progress mb-4 card-neoraised">
                                <div class="progress-bar progress-bar-striped progress-bar-animated border border-dark border-3 <?= $colors[$i % count($colors)]; ?>" role="progressbar"
                                    style="width: <?= ($kategori->total / $total_alat) * 100; ?>%" aria-valuenow="<?= ($kategori->total / $total_alat) * 100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <h6 class="m-0 fw-bolder text-black text-center">Bukti Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="splide" role="group" aria-label="Bukti Pembayaran Slider">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php foreach ($bukti_pembayaranya as $bukti) : ?>
                                            <li class="splide__slide d-flex align-items-center justify-content-center">
                                                <?php if (!empty($bukti['bukti_pembayaran'])): ?>
                                                    <img src="<?= base_url('public/img/bukti/' . $bukti['bukti_pembayaran']); ?>" alt="Slide" class="img-fluid mb-5" style="max-width: 100%;">
                                                <?php else: ?>
                                                    <p>Gambar tidak tersedia.</p>
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