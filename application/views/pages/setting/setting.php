<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('home') ?>" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold">Back</a>

                <a href="<?= base_url('akun/delete') ?>" class="btn btn-neoraised btn-danger btn-md mb-3 fw-bold">Hapus Akun</a>
            </div>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card-header">
                    <h3 class="card-title mb-4 text-center fw-bold">Ubah Data Akun</h3>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <?php if (file_exists('public/img/user/' . $user['foto_profil'])): ?>
                            <img src="<?php echo base_url('public/img/user/' . $user['foto_profil']); ?>" alt="<?= $user['nama']; ?>" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 10rem; height: 10rem; object-fit: contain;">
                        <?php else: ?>
                            <img src="<?= base_url('public/img/default.png') ?>" alt="<?= $user['nama']; ?>" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 10rem; height: 10rem; object-fit: contain;">
                        <?php endif; ?>
                        <?php if ($user['foto_profil'] !== 'default.png'): ?>
                            <button type="button" class="btn btn-neoraised btn-danger btn-sm ms-2 mt-auto mb-auto rounded-circle" onclick="confirmDeleteFoto()">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        <?php endif; ?>
                    </div>

                    <script>
                        function confirmDeleteFoto() {
                            const confirmBox = confirm("Anda yakin ingin menghapus foto profil?");
                            if (confirmBox) {
                                window.location.href = "<?= base_url('akun/deleteFoto') ?>";
                            } else {
                                return false;
                            }
                        }
                    </script>
                    <form action="<?php echo base_url('akun/update'); ?>" method="post" enctype="multipart/form-data">
                        <!-- Hidden input for id_user -->
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control card-neoraised" id="nama" name="nama" value="<?php echo $user['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control card-neoraised" id="no_hp" name="no_hp" value="<?php echo $user['no_telepon']; ?>" pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control card-neoraised" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control card-neoraised" id="password" name="password" minlength="6" required>
                        </div>
                        <div class="mb-3">
                            <label for="ulangi_password" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control card-neoraised" id="ulangi_password" name="ulangi_password" minlength="6" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="d-flex gap-3 align-items-center ms-2 ">
                                <div class="form-check">
                                    <input class="form-check-input card-neoraised fs-5" type="radio" value="L" id="L" name="jenkel" <?php echo ($user['jenis_kelamin'] == 'L') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label text-center" for="L">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input card-neoraised fs-5" type="radio" value="P" id="P" name="jenkel" <?php echo ($user['jenis_kelamin'] == 'P') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label text-center" for="P">
                                        Wanita
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input card-neoraised fs-5" type="radio" value="O" id="O" name="jenkel" <?php echo ($user['jenis_kelamin'] == 'O') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label text-center" for="O">
                                        Others
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control card-neoraised" id="alamat" name="alamat" rows="4" style="resize: none;" required><?php echo $user['alamat']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Priview Profile : </label>
                            <img src="<?php echo base_url('public/img/user/' . $user['foto_profil']); ?>" alt="<?= $user['nama']; ?>" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 5rem; height: 5rem; object-fit: contain;" id="preview-image">
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
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold">Ubah</button>
                            <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>