<div class="col-lg-6 col-md-6 col-sm-9 col-10 card bg-light card-body border border-dark border-3 mx-auto my-5 p-3 rounded-4 card-neoraised">
    <h1 class="fw-bolder display-5 mb-3 text-center text-dark mt-3">Register</h1>
    <form method="post" action="<?= base_url('register/register_action') ?>" enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="nama" class="form-label d-block fs-3 mt-3 fw-bold">Name</label>
            <input type="text" id="nama" name="nama" class="form-control fs-3 card-neoraised" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label d-block fs-3 mt-3 fw-bold">Email</label>
            <input type="email" id="username" name="username" class="form-control fs-3 card-neoraised" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label d-block fs-3 fw-bold">Password</label>
            <input type="password" id="password" name="password" class="form-control fs-3 card-neoraised" minlength="6" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label d-block fs-3 mt-3 fw-bold">No. HP</label>
            <input type="text" id="no_hp" name="no_hp" class="form-control fs-3 card-neoraised" pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$" title="Masukkan nomor HP yang benar" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label d-block fs-3 mt-3 fw-bold">Alamat</label>
            <textarea class="form-control card-neoraised fs-5" id="alamat" name="alamat" rows="4" style="resize: none;" required></textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label d-block fs-3 mt-3 fw-bold">Foto Profile <span class="text-danger fs-6"><br>*Format : heic, jpg, jpeg, png</span></label>
            <input type="file" class="form-control card-neoraised fs-5" id="foto" name="foto" accept=".heic,.jpg,.jpeg,.png">
        </div>
        <div class="form-check mb-sm-4 mb-3 ms-3">
            <input class="form-check-input fs-5 card-neoraised" type="checkbox" value="" id="flexCheckDefault" required>
            <label class="form-check-label fs-5 fw-light mb-3" for="flexCheckDefault">
                I agree to the terms and conditions
            </label>
        </div>
        <div class="d-flex justify-content-center mb-4">
            <button type="submit" class="btn btn-lg btn-neoraised btn-primary mx-2 mx-sm-auto px-3 py-3 fs-3 mb-4 fw-bold">Confirm</button>
            <button type="reset" class="btn btn-lg btn-neoraised btn-danger mx-2 mx-sm-auto px-3 py-3 fs-3 mb-4 fw-bold">Reset</button>
        </div>
        <div class="text-center mt-3">
            <p class="text-dark fs-5 fw-bold">Have an account? <br><a href="<?= base_url('login') ?>" class="text-warning fw-light">Sign In now!</a></p>
        </div>
    </form>
</div>
</div>