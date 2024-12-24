<?php

$title = " | Feedback";
include '../../templates/header4.php'; ?>

<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder">Data Feedback</h1>
        <a href="dashboard.php" class="btn btn-success btn-neoraised btn-md fw-bold mt-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Feedback</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Komentar</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Tanggal Feedback</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">3</td>
                    <td class="text-center">Alice Johnson</td>
                    <td class="text-center">Kompor</td>
                    <td class="text-center">A bit heavy, but works well.</td>
                    <td class="text-center">3</td>
                    <td class="text-center">2021-06-10</td>
                    <td class="text-center d-flex justify-content-center gap-3">
                        <button class="btn btn-primary btn-sm btn-neoraised fw-bold">Detail</button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Feedback</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Nama Alat</th>
                    <th class="text-center">Komentar</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Tanggal Feedback</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<?php
include '../../templates/footer.php'; ?>