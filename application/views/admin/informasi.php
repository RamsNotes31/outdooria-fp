<?php

$title = " | Informasi";
include '../../templates/header4.php'; ?>

<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder">Data Informasi</h1>
        <a href="dashboard.php" class="btn btn-success btn-neoraised btn-md fw-bold mt-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <div class="d-flex justify-content-center mb-3">
            <a href="tinformasi.php" class="btn btn-warning btn-neoraised btn-md fw-bold">Tambah Informasi</a>
        </div>

        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Informasi</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Nama Gunung</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Harga Biaya</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tanggal Update</th>
                    <th class="text-center">Foto Gunung</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">John Doe</td>
                    <td class="text-center">Gunung Gede</td>
                    <td class="text-center">Cianjur</td>
                    <td class="text-center">Rp 100,000</td>
                    <td class="text-center">Gunung Gede adalah gunung berapi yang terletak di perbatasan Kabupaten Cianjur dan Kabupaten Sukabumi, Jawa Barat, Indonesia.</td>
                    <td class="text-center">2022-11-01</td>
                    <td class="text-center"><img src="https://fotomhs.amikom.ac.id/2023/23_12_2925.jpg" alt="Profile 3" width="50" height="50" class="rounded-3 border border-dark card-neoraised"></td>
                    <td class="text-center d-flex justify-content-center gap-3">
                        <a href="einformasi.php" class="btn btn-primary btn-sm btn-neoraised fw-bold">Edit</a>
                        <button class="btn btn-danger btn-sm btn-neoraised fw-bold">Delete</button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Informasi</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Nama Gunung</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Harga Biaya</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tanggal Update</th>
                    <th class="text-center">Foto Gunung</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<?php
include '../../templates/footer.php'; ?>