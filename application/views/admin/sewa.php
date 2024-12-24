<?php

$title = " | Sewa";
include '../../templates/header4.php'; ?>

<div class="container-fluid py-5 px-3">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder">Data Penyewaan</h1>
        <a href="dashboard.php" class="btn btn-success btn-neoraised btn-md fw-bold mt-3">Back To Dasboard</a>
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
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">John Doe</td>
                    <td class="text-center">Hammer</td>
                    <td class="text-center">SA001</td>
                    <td class="text-center">2022-11-01</td>
                    <td class="text-center">2022-11-05</td>
                    <td class="text-center">Rp 100,000</td>
                    <td class="text-center">Pending</td>
                    <td class="text-center"><img src="https://fotomhs.amikom.ac.id/2023/23_12_2925.jpg" alt="Profile 3" width="50" height="50" class="rounded-3 border border-dark card-neoraised"></td>
                </tr>
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
</div>

<?php include '../../templates/footer.php'; ?>