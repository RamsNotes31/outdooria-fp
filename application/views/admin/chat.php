<?php

$title = " | Chat";
include '../../templates/header4.php'; ?>

<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder">Data Chat</h1>
        <a href="dashboard.php" class="btn btn-success btn-neoraised btn-md fw-bold mt-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Nama Users</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">Alice Johnson</td>
                    <td class="text-center">Admin 3</td>
                    <td class="text-center d-flex justify-content-center gap-3">
                        <a href="detail.php" class="btn btn-primary btn-sm btn-neoraised fw-bold">Detail</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Nama Users</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<?php
include '../../templates/footer.php'; ?>