<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 py-lg-5 py-2 px-2">
        <div class="col-12 col-lg-7 col-xl-10">
            <a href="<?= base_url('admin/data_alat'); ?>" class="btn btn-neoraised btn-primary btn-md mb-3 fw-bold border border-2 border-dark">Back</a>
            <div class="card-neoraised border border-2 border-dark py-3 px-3 rounded-3">
                <div class="card card-header card-neoraised border border-2 border-dark rounded mb-3">
                    <h3 class="card-title mb-4 text-center fw-bold mt-4 text-black">Ubah Data Alat</h3>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <?php if (file_exists("public/img/produk/" . $data['foto_produk'])) { ?>
                            <img src="<?= base_url('public/img/produk/' . $data['foto_produk']); ?>" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill mb-4" style="width: 10rem; height: 10rem;">
                        <?php } else { ?>
                            <img src="<?= base_url('public/img/produk/default.jpg'); ?>" alt="Outdooria" class="img-fluid border border-dark border-3 card-neoraised rounded-pill mb-4" style="width: 10rem; height: 10rem;">
                        <?php } ?>
                        <?php if ($data['foto_produk'] !== 'default.jpg'): ?>
                            <button type="button" class="btn btn-neoraised btn-danger btn-sm ms-2 mt-auto mb-auto rounded-circle border border-3 border-dark" onclick="confirmDeleteFoto()">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                    <script>
                        function confirmDeleteFoto() {
                            const confirmBox = confirm("Anda yakin ingin menghapus foto profil?");
                            if (confirmBox) {
                                window.location.href = "<?= base_url('admin/deleteAlat/' . $data['id_alat']) ?>";
                            } else {
                                return false;
                            }
                        }
                    </script>
                </div>
                <form action="<?= base_url('admin/updateAlat/'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_alat" value="<?= $data['id_alat']; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label text-black text-black">Nama Alat</label>
                        <input type="text" class="form-control card-neoraised border border-2 border-dark text-black" id="nama" name="nama" required value="<?= $data['nama_alat']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label text-black">Kategori</label>
                        <select class="form-select card-neoraised text-black border border-2 border-dark" id="kategori" name="kategori" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <?php foreach ($kategori_options as $kategori): ?>
                                <option value="<?php echo $kategori; ?>" <?= $data['kategori'] == $kategori ? 'selected' : ''; ?>><?php echo ucfirst($kategori); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label text-black visually-hidden">Stok</label>
                        <input type="hidden" min="0" class="form-control card-neoraised text-black border border-2 border-dark" id="stok" name="stok" required value="<?= $data['stok']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="harga_sewa" class="form-label text-black">Harga Sewa</label>
                        <input type="number" min="0" class="form-control card-neoraised text-black border border-2 border-dark" id="harga_sewa" name="harga_sewa" required value="<?= $data['harga_sewa']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label text-black">Deskripsi</label>
                        <textarea class="form-control card-neoraised text-black border border-2 border-dark" id="deskripsi" name="deskripsi" rows="4" style="resize: none;" required><?= $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label text-black">Priview Profile : </label>
                        <?php if (file_exists('public/img/produk/' . $data['foto_produk'])): ?>
                            <img src="<?php echo base_url('public/img/produk/' . $data['foto_produk']); ?>" alt="Foto Profil" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 5rem; height: 5rem; object-fit: contain;" id="preview-image">
                        <?php else: ?>
                            <img src="<?php echo base_url('public/img/produk/default.jpg'); ?>" alt="Foto Profil" class="img-fluid border border-dark border-3 card-neoraised rounded-pill" style="width: 5rem; height: 5rem; object-fit: contain;" id="preview-image">
                        <?php endif; ?>
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
                        <button type="submit" class="btn btn-neoraised btn-success mb-3 mt-4 btn-md fw-bold border border-2 border-dark">Ubah</button>
                        <button type="reset" class="btn btn-neoraised btn-danger mb-3 mt-4 btn-md fw-bold border border-2 border-dark">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>