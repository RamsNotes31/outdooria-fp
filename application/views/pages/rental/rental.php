<?php
defined('BASEPATH') or
    header("Location: error");
?>

<div class="container-fluid mt-5">
    <h1 class="text-center fw-bolder mb-5">Our Products</h1>

    <div class="row">
        <div class="col-12 ">
            <div class="card-body">
                <div class="splide" id="splide" role="group" aria-label="Main Slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($img_alat as $view) : ?>
                                <li class="splide__slide d-flex align-items-center justify-content-center me-5">
                                    <?php if (!empty($view['foto_produk'])): ?>
                                        <img src="<?= base_url('public/img/produk/' . $view['foto_produk']); ?>" alt="Slide" class="img-fluid mb-3 card-neoraised border border-dark border-3 rounded-3" height="1000" width="1000">
                                    <?php else: ?>
                                        <p>Gambar tidak tersedia.</p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Splide('.splide').mount(window.splide.Extensions);
        const splide = new Splide('.splide', {
            type: 'loop',
            arrows: false,
            focus: 'center',
            pagination: false,
            perPage: 1,
            autoScroll: {
                speed: 1,
            },
        });

        splide.mount()
    });
</script>

<div class="container mt-5">
    <form class="mb-5" role="search" method="post" action="<?= base_url('produk'); ?>">
        <div class="row mb-3">
            <div class="col-auto">
                <a href="<?= base_url('home'); ?>" class="btn btn-outline-info btn-neoraised fw-bold me-2">Back</a>
            </div>
            <div class="col">
                <select class=" form-select me-2 card-neoraised" id="sort" name="sort" aria-label="sort">
                    <option value="0" selected>All</option>
                    <option value="1">Price Ascending</option>
                    <option value="2">Price Descending</option>
                    <option value="3">Popularity</option>
                    <option value="4">Rating</option>
                    <option value="5">Favorit</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input class="form-control me-2 card-neoraised" type="search" placeholder="Search" name="search" aria-label="Search">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select class="form-select me-2 card-neoraised" id="kategori" name="kategori" aria-label="Kategori">
                    <option value="0" selected>All</option>
                    <?php foreach ($alat_pendakian as $alat): ?>
                        <option value="<?= $alat->kategori; ?>"><?= ucfirst($alat->kategori); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-auto">
                <button class="btn btn-outline-info btn-neoraised fw-bold" type="submit">Search</button>
            </div>
        </div>
    </form>


    <div class="row">
        <?php if (!empty($produks) && is_array($produks)): ?>
            <?php foreach ($produks as $produk): ?>
                <div class="col-xl-4 col-sm-6 col-lg-4 mb-3 col-md-6 col-6">
                    <div class="card card-neoraised mb-3 py-3 px-3 d-flex flex-column" style="height: 100%;">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Menampilkan gambar produk -->
                                <img src="<?= base_url("public/img/produk/" . $produk['foto_produk']); ?>"
                                    class="img-fluid border border-dark border-3 rounded-3 card-neoraised"
                                    alt="<?= $produk['nama_alat']; ?>">
                                <div class="d-flex justify-content-center mt-3 mb-md-2">


                                    <?php if (isset($favorit) && in_array($produk['id_alat'], $favorit)): ?>
                                        <a href="<?= base_url('produk/wishlist/' . $produk['id_alat']); ?>"
                                            class="btn btn-sm btn-neoraised btn-danger me-md-5 me-4">
                                            <i class="bi bi-heart-fill text-white fs-5"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('produk/wishlist/' . $produk['id_alat']); ?>"
                                            class="btn btn-sm btn-neoraised btn-light me-md-5 me-4">
                                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Tombol Detail -->
                                    <a href="<?= base_url('produk/detail/' . $produk['id_alat']); ?>"
                                        class="btn btn-sm btn-neoraised btn-primary">
                                        <i class="bi bi-cart text-white fs-5"></i>
                                    </a>
                                </div>
                                <div class="text-center text-muted mt-3">
                                    Favorit : (<?= $produk['favorit_count'] ?? 0; ?>)<br>
                                    Telah dipinjam : (<?= $produk['popularity_count'] ?? 0; ?>)<br>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex flex-column justify-content-between">
                                <!-- Nama Produk -->
                                <h3 class="card-title mt-md-3 fw-bolder mt-4 mb-3 text-center" style="min-height: 60px;"><?= $produk['nama_alat']; ?></h3>

                                <!-- Informasi Stok -->
                                <h4 class="card-title mt-md-3 mb-3 text-center fw-bold">
                                    Stok
                                    <span class="badge rounded-pill text-bg-success card-neoraised fw-bold"><?= $produk['stok']; ?></span>
                                </h4>

                                <!-- Rating Produk -->
                                <div class="d-flex justify-content-center flex-sm-row flex-column">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <div class="d-flex">
                                            <?php
                                            $rating = $produk['rata_rata_rating'] !== null ? floor($produk['rata_rata_rating']) : 0; // Pastikan rating tidak null sebelum floor
                                            $hasHalfStar = ($produk['rata_rata_rating'] - $rating) >= 0.5; // Cek jika ada bintang setengah
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="bi bi-star-fill text-warning fs-4"></i>';
                                                } elseif ($hasHalfStar && $i == $rating + 1) {
                                                    echo '<i class="bi bi-star-half text-warning fs-4"></i>';
                                                    $hasHalfStar = false;
                                                } else {
                                                    echo '<i class="bi bi-star text-muted fs-4"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p class="text-center mt-2 fs-6 fw-light">(<?= $produk['total_feedback'] ?? 0; ?>) <?= is_null($produk['rata_rata_rating']) ? '0.0' : number_format((float) $produk['rata_rata_rating'], 1); ?>/5.0</p>
                                    </div>
                                </div>

                                <!-- Informasi Favorit dan Popularitas -->

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Tidak ada produk tersedia.</p>
        <?php endif; ?>
    </div>