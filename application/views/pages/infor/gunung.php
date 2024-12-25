<div class="container mt-5">

    <form class="mb-5" role="search" method="post" action="<?= base_url('gunung'); ?>">
        <div class="row mb-3">
            <div class="col-auto">
                <a href="<?= base_url('home'); ?>" class="btn btn-outline-info btn-neoraised fw-bold me-2">Back</a>
            </div>
            <div class="col">
                <select class="form-select me-2 card-neoraised" id="kategori" name="kategori" aria-label="Kategori">
                    <option value="0" selected>All</option>
                    <option value="1">Price Ascending</option>
                    <option value="2">Price Descending</option>
                    <option value="3">New</option>
                </select>
            </div>

        </div>

        <div class="row mb-3">
            <div class="col">
                <input class="form-control card-neoraised" type="search" name="search" placeholder="Search" aria-label="Search">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select class="form-select me-2 card-neoraised" id="lokasi" name="lokasi" aria-label="Lokasi">
                    <option value="" selected>All Locations</option>
                    <?php if (isset($lokasi_options) && count($lokasi_options) > 0): ?>
                        <?php foreach ($lokasi_options as $lokasi): ?>
                            <option value="<?= htmlspecialchars(substr($lokasi['lokasi'], 0, strpos($lokasi['lokasi'], ','))); ?>"><?= htmlspecialchars(substr($lokasi['lokasi'], 0, strpos($lokasi['lokasi'], ','))); ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No Locations Available</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-info btn-neoraised fw-bold" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div class="row px-lg-0 px-3">
        <?php if (isset($informasi) && count($informasi) > 0): ?>
            <?php foreach ($informasi as $info): ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-3 px-3 py-3">
                    <div class="card card-neoraised mb-3 py-3 px-3  d-flex flex-column" style="height: 100%;">
                        <div class="row">
                            <div class="col-12">
                                <img src="<?= base_url('public/img/gunung/' . $info['foto_gunung']); ?>" class="img-fluid border border-dark border-3 rounded-3 card-neoraised" alt="<?= htmlspecialchars($info['nama_gunung']); ?>">
                                <p class="text-center mt-3 fw-bold">
                                    Oleh Admin: <span class="badge rounded-pill card-neoraised bg-primary text-white"><?= htmlspecialchars($info['nama_admin']); ?></span>
                                </p>
                                <div class="row">
                                    <div class="col-12 col-md-9">
                                        <h5 class="card-title mt-3 fw-bolder text-left fs-5"><?= htmlspecialchars($info['nama_gunung']); ?></h5>
                                        <p class="card-text text-left fw-light">Lokasi: <?= htmlspecialchars($info['lokasi']); ?></p>
                                    </div>
                                    <div class="col-12 col-lg-3 d-flex align-items-center justify-content-end ms-auto mt-3">
                                        <a href="<?= base_url('gunung/info/' . $info['id_informasi']); ?>" class="btn btn-lg btn-neoraised btn-success text-white fw-bolder">
                                            Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No results found.</p>
            <div class="row justify-content-center mt-4">
                <button class="btn btn-outline-success btn-neoraised fw-bold" onclick="window.location.href='<?= base_url('gunung'); ?>'">Refresh</button>
            </div>

        <?php endif; ?>
    </div>
</div>