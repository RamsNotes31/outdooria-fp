<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="<?= base_url('admin/data_informasi'); ?>" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold border border-dark border-3 ">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card card-header border border-2 border-dark card-neoraised rounded-3 mb-3">
                    <h3 class="card-title mb-4 text-center fw-bold mt-4 text-black">Tambah Data Informasi</h3>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="<?php echo base_url('public/img/gunung/default.jpg'); ?>" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill mb-3" style="width: 10rem; height: 10rem;">
                    </div>
                    <form action="<?= base_url('admin/tambah_informasi'); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label text-black visually-hidden">Nama Admin</label>
                            <input type="hidden" class="form-control card-neoraised text-black border border-dark border-3" id="nama" name="nama" value="<?= $this->session->userdata('nama_admin') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="admin" class="form-label text-black">Nama Gunung</label>
                            <input type="text" class="form-control card-neoraised text-black border border-dark border-3" id="admin" name="admin" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_biaya" class="form-label text-black">Harga Biaya</label>
                            <input type="number" min="0" class="form-control card-neoraised text-black border border-dark border-3" id="harga_biaya" name="harga_biaya" required>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label text-black">Lokasi</label>
                            <input type="text" class="form-control card-neoraised text-black border border-dark border-3" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label text-black">Deskripsi</label>
                            <textarea class="form-control card-neoraised text-black border border-dark border-3" id="deskripsi" name="deskripsi" rows="4" style="resize: none;" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label text-black">Priview Profile : </label>
                            <img src="<?php echo base_url('public/img/gunung/default.jpg'); ?>" alt="Foto Profil" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 5rem; height: 5rem; object-fit: contain;" id="preview-image">
                            <p id="error-format" class="text-danger mt-2 d-none">*Format file hanya jpeg, jpg, png, heic</p>
                            <input type="file" class="form-control card-neoraised mt-3 border border-dark border-3" id="foto" name="foto" accept=".jpeg, .jpg, .png, .heic" onchange="previewFile()">
                            <p id="error-message" class="text-danger mt-2 d-none">*File tidak support</p>

                            <script>
                                function previewFile() {
                                    const preview = document.getElementById('preview-image');
                                    const file = document.getElementById('foto').files[0];
                                    const errorFormat = document.getElementById('error-format');
                                    const submitButton = document.querySelector('button[type="submit"]');

                                    if (file) {
                                        const fileType = file.type;
                                        if (fileType.startsWith('image/')) {
                                            const reader = new FileReader();
                                            reader.onloadend = function() {
                                                preview.src = reader.result;
                                                preview.alt = file.name;
                                                errorFormat.classList.add('d-none');
                                                submitButton.disabled = false;
                                            };
                                            reader.readAsDataURL(file);
                                        } else {
                                            preview.src = "";
                                            preview.alt = "";
                                            preview.classList.add('d-none');
                                            errorFormat.classList.remove('d-none');
                                            submitButton.disabled = true;
                                        }
                                    } else {
                                        preview.src = "";
                                        preview.alt = "";
                                        errorFormat.classList.add('d-none');
                                        submitButton.disabled = false;
                                    }
                                }
                            </script>

                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold border border-dark border-3">Tambah</button>
                            <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold border border-dark border-3">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>