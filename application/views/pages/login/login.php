<div class="d-flex justify-content-center align-items-center py-5">
    <div class="col-lg-6 col-md-6 col-sm-9 col-10 card bg-light card-neoraised mx-auto my-5 p-3 rounded-4 card-neoraised border border-3 border-dark">
        <h1 class="fw-bolder display-5 mb-3 text-center text-dark mt-3">Login First!</h1>
        <form method="post" action="<?= base_url('login/login_action') ?>">
            <div class="mb-3">
                <label for="email" class="form-label d-block fs-3 mt-3 fw-bold">Email</label>
                <input type="email" id="email" name="email" class="form-control fs-3 card-neoraised" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label d-block fs-3 fw-bold">Password</label>
                <input type="password" id="password" name="password" class="form-control fs-3 card-neoraised" required>
            </div>
            <div class="form-check mb-sm-4 mb-3 ms-3 ">
                <input class="form-check-input fs-5 card-neoraised" type="checkbox" value="" id="flexCheckDefault" required>
                <label class="form-check-label fs-5 fw-light mb-3" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-lg btn-neoraised btn-primary mx-2 mx-sm-auto px-3 py-3 fs-3 mb-4 fw-bold" id="login">Login</button>
                <button type="reset" class="btn btn-lg btn-neoraised btn-danger mx-2 mx-sm-auto px-3 py-3 fs-3 mb-4 fw-bold">Reset</button>
            </div>
            <div class="text-center mt-3">
                <p class="text-dark fs-5 fw-bold">Not have an account?<br><a href="<?= base_url('register') ?>" class="text-warning fw-light">Sign up now!</a></p>
            </div>
        </form>
    </div>
</div>