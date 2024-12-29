<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold border border-3 border-dark">Back</a>

                <a href="<?= base_url('admin/hapus') ?>" class="btn btn-neoraised btn-danger btn-md mb-3 fw-bold border border-3 border-dark">Hapus Akun</a>
            </div>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3 border border-3 border-dark">
                <div class="card-header border border-3 border-dark card-neoraised rounded-3">
                    <h3 class="card-title mb-4 mt-4 text-center fw-bold text-black">Ubah Data Saya</h3>
                </div>

                <div class="card-body mt-4">
                    <div class="d-flex justify-content-center mb-5">
                        <?php if (file_exists('public/img/admin/' . $mimin->foto_admin)): ?>
                            <img src="<?= base_url('public/img/admin/' . $mimin->foto_admin) ?>" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 10rem; height: 10rem;">
                        <?php else: ?>
                            <img src="<?= base_url('public/img/default.png') ?>" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 10rem; height: 10rem;">
                        <?php endif; ?>
                        <?php if ($mimin->foto_admin !== 'default.png'): ?>
                            <button type="button" class="btn btn-neoraised btn-danger btn-sm ms-2 mt-auto mb-auto rounded-circle border border-3 border-dark" onclick="confirmDeleteFoto()">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        <?php endif; ?>
                    </div>

                    <script>
                        function confirmDeleteFoto() {
                            const confirmBox = confirm("Anda yakin ingin menghapus foto profil?");
                            if (confirmBox) {
                                window.location.href = "<?= base_url('admin/deleteFoto') ?>";
                            } else {
                                return false;
                            }
                        }
                    </script>
                    <form action="<?= base_url('admin/ubah') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label d-block fs-5 mt-3 fw-bold text-black">Name</label>
                            <input type="text" id="nama" name="nama" class="form-control fs-5 card-neoraised" required value="<?= $mimin->nama_admin ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label d-block fs-5 mt-3 fw-bold text-black">Email</label>
                            <input type="email" id="username" name="username" class="form-control fs-5 card-neoraised" required value="<?= $mimin->email_admin ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label d-block fs-5 fw-bold text-black">Password</label>
                            <input type="password" id="password" name="password" class="form-control fs-5 card-neoraised" minlength="6" required value="<?= $mimin->password_admin ?>">
                        </div>
                        <div class="mb-3">
                            <label for="confirmpassword" class="form-label d-block fs-5 fw-bold text-black">Confirm Password</label>
                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control fs-5 card-neoraised" minlength="6" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block fs-5 mt-3 fw-bold text-black">Jenis Kelamin</label>
                            <div class="d-flex gap-3 align-items-center ms-2 ">
                                <div class="form-check">
                                    <input class="form-check-input card-neoraised fs-5" type="radio" value="L" id="L" name="jenkel" required <?= ($mimin->jenis_kelamin == 'L') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-center" for="L">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input card-neoraised fs-5" type="radio" value="P" id="P" name="jenkel" required <?= ($mimin->jenis_kelamin == 'P') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-center" for="P">
                                        Wanita
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input card-neoraised fs-5" type="radio" value="O" id="O" name="jenkel" required <?= ($mimin->jenis_kelamin == 'O') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-center" for="O">
                                        Others
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label d-block fs-5 mt-3 fw-bold text-black">No. HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control fs-5 card-neoraised" pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$" title="Masukkan nomor HP yang benar" required value="<?= $mimin->no_telp_admin ?>">
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label fw-bold text-black">Priview Profile : </label>
                            <?php if (file_exists('public/img/admin/' . $mimin->foto_admin)): ?>
                                <img src="<?php echo base_url('public/img/admin/' . $mimin->foto_admin); ?>" alt="Foto Profil" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 5rem; height: 5rem; object-fit: contain;" id="preview-image">
                            <?php else: ?>
                                <img src="<?php echo base_url('public/img/default.png'); ?>" alt="Foto Profil" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 5rem; height: 5rem; object-fit: contain;" id="preview-image">
                            <?php endif; ?>
                            <p id="error-format" class="text-danger mt-2 d-none">*Format file hanya jpeg, jpg, png, heic</p>
                            <input type="file" class="form-control card-neoraised mt-3" id="foto" name="foto" accept=".jpeg, .jpg, .png, .heic" onchange="previewFile()">
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
                        <div class="d-flex justify-content-between text-black">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold border border-3 border-dark">Ubah</button>
                            <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold border border-3 border-dark">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>