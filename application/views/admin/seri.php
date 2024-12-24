<?php

$title = " | Seri";
include '../../templates/header4.php'; ?>

<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder">Data Seri Alat</h1>
        <a href="dashboard.php" class="btn btn-success btn-neoraised btn-md fw-bold mt-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <div class="d-flex justify-content-center mb-3">
            <a href="tseri.php" class="btn btn-warning btn-neoraised btn-md fw-bold">Tambah Seri</a>
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
                <tr>
                    <td class="text-center">SA001</td>
                    <td class="text-center">Hammer</td>
                    <td class="text-center">Good</td>
                    <td class="text-center">Available</td>
                    <td class="text-center">2023-05-20</td>
                    <td class="text-center d-flex justify-content-center gap-3">
                        <a href="eseri.php" class="btn btn-primary btn-sm btn-neoraised fw-bold">Edit</a>
                        <button class="btn btn-danger btn-sm btn-neoraised fw-bold">Delete</button>
                    </td>
                </tr>
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

<?php
include '../../templates/footer.php'; ?>