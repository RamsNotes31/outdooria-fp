<?php

$title = " | Admin";
include '../../templates/header4.php'; ?>

<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder">Data Admin</h1>
        <a href="dashboard.php" class="btn btn-success btn-neoraised btn-md fw-bold mt-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <div class="d-flex justify-content-center mb-3">
            <a href="tadmin.php" class="btn btn-warning btn-neoraised btn-md fw-bold">Tambah Admin</a>
        </div>

        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Admin</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Email Admin</th>
                    <th class="text-center">No Telp</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Tanggal Daftar</th>
                    <th class="text-center">Foto Profile</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">John Doe</td>
                    <td class="text-center">johndoe@example.com</td>
                    <td class="text-center">123456789</td>
                    <td class="text-center">123456789</td>
                    <td class="text-center">password123</td>
                    <td class="text-center">2022-11-01</td>
                    <td class="text-center"><img src="https://fotomhs.amikom.ac.id/2023/23_12_2925.jpg" alt="Profile 3" width="50" height="50" class="rounded-circle border border-dark card-neoraised"></td>
                    <td class="text-center d-flex justify-content-center gap-3">
                        <a href="eadmin.php" class="btn btn-primary btn-sm btn-neoraised fw-bold">Edit</a>
                        <button class="btn btn-danger btn-sm btn-neoraised fw-bold">Delete</button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Admin</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Email Admin</th>
                    <th class="text-center">No Telp</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Tanggal Daftar</th>
                    <th class="text-center">Foto Profile</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<?php
include '../../templates/footer.php'; ?>