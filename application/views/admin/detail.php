<?php

$title = " | Detail";
include '../../templates/header4.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12 mx-auto rounded-3">
            <div class="card card-body border border-3 border-dark card-neoraised rounded-3" style="height: 74vh; overflow-y: scroll;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="card-title fw-bolder text-center mb-5">Chat User : Nama</h1>
                        <button onclick="history.back()" class="btn btn-neoraised btn-success btn-md fw-bold">Kembali</button>
                    </div>
                    <?php include '../../components/cs.php'; ?>

                    <div class="row">
                        <div class="col-12 mt-4 ms-auto mt-5 mb-3">
                            <form method="POST" action="chat_handler.php" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <textarea class="form-control card-neoraised" name="message" rows="2" placeholder="Tulis pesan..." aria-label="Tulis pesan" style="resize: none;"></textarea>
                                    <button class="btn btn-primary btn-neoraised fw-bold" type="submit">Kirim</button>
                                </div>
                                <div class="input-group mb-3">
                                    <button class="btn btn-success btn-neoraised dropdown-toggle fw-bold" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Upload Gambar
                                    </button>
                                    <ul class="dropdown-menu card-neoraised px-3 border border-dark border-2 w-100" aria-labelledby="dropdownMenuButton">
                                        <li><input type="file" name="image" accept="image/*" class="form-control-file card-neoraised border border-2 border-dark rounded-3" style="width: 100%;"></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
include '../../templates/footer.php'; ?>