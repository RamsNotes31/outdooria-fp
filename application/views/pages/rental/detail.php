<?php if (!empty($product) && isset($product['id_alat'])): ?>
    <div class="container mt-5 py-5">
        <div class="row">
            <!-- Gambar dan Rating -->
            <div class="col-md-6 d-flex justify-content-center mb-5 align-items-center">
                <div class="row">
                    <div class="col-md-12 px-5 text-center">
                        <img src="<?= base_url('public/img/produk/' . $product['foto_produk']); ?>" class="img-fluid border border-dark border-3 rounded-5 card-neoraised" alt="<?= $product['nama_alat']; ?>">
                        <!-- Wishlist Button -->
                        <div class="d-flex justify-content-center">
                            <?php if (isset($favorit) && in_array($product['id_alat'], $favorit)): ?>
                                <a href="<?= base_url('produk/wishlist/' . $product['id_alat']); ?>"
                                    class="btn btn-danger btn-neoraised btn-lg mt-4 fw-bolder">
                                    Remove from Wishlist
                                    <i class="bi bi-heart-fill text-white fs-5"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('produk/wishlist/' . $product['id_alat']); ?>"
                                    class="btn btn-light btn-neoraised btn-lg mt-4 fw-bolder">
                                    Add to Wishlist
                                    <i class="bi bi-heart-fill text-danger fs-5"></i>
                                </a>
                            <?php endif; ?>

                        </div>
                        <div class="text-center text-muted mt-3">
                            Favorit: (<?= isset($t['favorit_count']) ? htmlspecialchars($t['favorit_count'], ENT_QUOTES, 'UTF-8') : 0; ?>)<br>
                            Telah dipinjam: (<?= isset($d['popularity_count']) ? htmlspecialchars($d['popularity_count'], ENT_QUOTES, 'UTF-8') : 0; ?>)<br>
                        </div>

                        <div class="d-flex justify-content-center flex-sm-row flex-column mt-5">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <?php if ($product['rata_rata_rating'] - $i >= 1): ?>
                                            <i class="bi bi-star-fill text-warning fs-1"></i>
                                        <?php elseif ($product['rata_rata_rating'] - $i >= 0.5): ?>
                                            <i class="bi bi-star-half text-warning fs-1"></i>
                                        <?php else: ?>
                                            <i class="bi bi-star text-muted fs-1"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-center mt-2 fs-4">
                                    (<?= htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); ?>)
                                    <?= number_format(htmlspecialchars($product['rata_rata_rating'], ENT_QUOTES, 'UTF-8'), 1); ?>/5.0
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail dan Form -->
            <div class="col-md-6 align-items-center">
                <h2 class="text-center mb-5 fw-bolder">Booking Form</h2>
                <?php $nama_alats = $product['nama_alat']; ?>
                <h3 class="card-title mt-md-3 fw-bolder mt-4 mb-3 text-left"><?= $nama_alats; ?></h3>
                <p class="card-text fs-5 text-left">Rp. <?= number_format((float) $product['harga_sewa'], 0, ',', '.'); ?> </p>
                <h4 class="card-title mt-md-3 mb-4 text-left mt-3 fw-bold">
                    Kategori <span class="badge rounded-pill text-bg-info card-neoraised"><?= $product['kategori']; ?></span>
                </h4>
                <p class="card-text fs-5 text-left fw-normal text-wrap">
                    <strong>Deskripsi:</strong> <?= $product['deskripsi']; ?>
                </p>
                <h4 class="card-title mt-md-3 mb-4 text-left mt-3 fw-bold">
                    Stok <span class="badge rounded-pill text-bg-success card-neoraised"><?= $product['stok']; ?></span>
                </h4>

                <form method="POST" action="<?= site_url('produk/submit'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_alat" value="<?= $product['id_alat']; ?>">
                    <div class="mb-3">
                        <label for="bookingDate" class="form-label">Tanggal Pemesanan</label>
                        <input type="date" class="form-control card-neoraised" id="bookingDate" name="bookingDate" value="<?= date('Y-m-d'); ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="returnDate" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control card-neoraised" id="returnDate" name="returnDate" value="<?= date('Y-m-d', strtotime('+3 days')); ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="itemSelect" class="form-label">Pilih Barang</label>
                        <select class="form-select card-neoraised" id="itemSelect" name="itemSelect" required>
                            <option value="" disabled selected>Choose an item</option>
                            <?php foreach ($series as $item): ?>
                                <option value="<?= $item['seri_alat']; ?>">Kode : <?= $item['seri_alat']; ?> | <?= $item['kondisi']; ?> | <?= $item['status_produk']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between mt-3 mb-5">
                        <button type="submit" class="btn btn-warning btn-neoraised fw-bold">Booking Now</button>
                        <a href="<?= base_url('produk'); ?>" class="btn btn-primary btn-neoraised fw-bold">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container px-3">
        <div class="row py-5">
            <div class="col-lg-5 order-2 order-lg-1">
                <h2 class="text-center mb-4 mt-md-5 mt-5 fw-bolder">Related Product</h2>
                <div class="row">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $produc): ?>
                            <div class="col-6 col-sm-4 col-lg-6 mt-5">
                                <div class="card card-neoraised py-2 px-2 mb-4 d-flex flex-column" style="height: 100%;">
                                    <h3 class="card-title text-center mt-2 mb-3 fw-bold"><?= $produc['nama_alat']; ?></h3>
                                    <img src="<?= base_url('public/img/produk/' . $produc['foto_produk']); ?>"
                                        class="img-fluid border border-dark border-3 rounded-3 card-neoraised"
                                        alt="<?= $produc['nama_alat']; ?>">
                                    <div class="d-flex justify-content-center mt-3 mb-md-2">
                                        <a href="<?= base_url('produk/detail/' . $produc['id_alat']); ?>"
                                            class="btn btn-md btn-neoraised btn-primary mb-3 fw-bold">
                                            Check Out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">Tidak ada produk lain yang tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-7 order-1 order-lg-2">
                <h2 class="text-center mb-4 mt-md-5 mt-0 fw-bolder">Rating & Review</h2>
                <div class="rating-review-form">
                    <form method="post" action="<?= base_url('produk/review') ?>" class="mb-4">
                        <div class="form-group">
                            <label for="nama_alat" class="visually-hidden">Nama Alat</label>
                            <input type="hidden" id="nama_alat" name="nama_alat" value="<?= $product['nama_alat'] ?>">
                            <label for="userRating" class="form-label mt-5">Your Rating: <span id="rating-text"><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i><i class="bi bi-star text-muted"></i></span></label>
                            <div class="d-flex align-items-center">
                                <input type="range" id="userRating" name="rating" class="form-control card-neoraised" min="0" max="5" step="0.5" value="0" required>

                            </div>
                            <script>
                                const ratingInput = document.getElementById('userRating');
                                const ratingText = document.getElementById('rating-text');
                                ratingInput.addEventListener('input', function() {
                                    const rating = Number(ratingInput.value);
                                    const stars = [];
                                    for (let i = 0; i < 5; i++) {
                                        if (rating >= (i + 1)) {
                                            stars.push('<i class="bi bi-star-fill text-warning"></i>');
                                        } else if (rating >= (i + 0.5)) {
                                            stars.push('<i class="bi bi-star-half text-warning"></i>');
                                        } else {
                                            stars.push('<i class="bi bi-star text-muted"></i>');
                                        }
                                    }
                                    ratingText.innerHTML = stars.join('');
                                });
                            </script>
                        </div>
                        <div class="form-group mt-3">
                            <label for="userComment" class="form-label">Your Comment:</label>
                            <textarea id="userComment" name="comment" class="form-control card-neoraised" rows="4" required style="resize: none;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-neoraised btn-success mt-3 fw-bold">Submit Review</button>
                    </form>

                </div>

                <div class="user-reviews">
                    <h3 class="text-center mb-4 mt-5 fw-bolder">User Reviews</h3>
                    <!-- <div class="d-flex justify-content-center gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input btn-neoraised fs-5" type="radio" name="sort" id="tertinggi" value="tertinggi" checked>
                            <label class="form-check-label" for="tertinggi">Highest Rating</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input btn-neoraised fs-5" type="radio" name="sort" id="terendah" value="terendah">
                            <label class="form-check-label" for="terendah">Lowest Rating</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input btn-neoraised fs-5" type="radio" name="sort" id="terbaru" value="terbaru">
                            <label class="form-check-label" for="terbaru">Newest</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input btn-neoraised fs-5" type="radio" name="sort" id="terlama" value="terlama">
                            <label class="form-check-label" for="terlama">Oldest</label>
                        </div>
                    </div> -->
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="card card-neoraised p-3 mb-3">
                                <div class="d-flex">

                                    <img src="<?= empty($review['foto_profil']) ? base_url('public/img/user/deleted.jpg') : base_url('public/img/user/' . $review['foto_profil']); ?>" \
                                        alt="<?= $review['nama']; ?>" \
                                        class="rounded-circle me-2 mb-3 border border-2 border-dark card-neoraised"
                                        width="40" height="40">
                                    <h5 class="card-title fw-bold align-self-center"><a href="<?= base_url('akun/profil/' . ($review['nama'])); ?>" style="text-decoration: none;"><?= $review['nama']; ?></a></h5>
                                </div>
                                <p class="card-text"><?= '"' . htmlspecialchars($review['komentar']) . '"'; ?></p>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><small class="text-muted">
                                            <?php
                                            $rating = floor($review['rating']);
                                            $hasHalfStar = ($review['rating'] - $rating) >= 0.5;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="bi bi-star-fill text-warning"></i>';
                                                } elseif ($hasHalfStar && $i == $rating + 1) {
                                                    echo '<i class="bi bi-star-half text-warning"></i>';
                                                    $hasHalfStar = false;
                                                } else {
                                                    echo '<i class="bi bi-star text-muted"></i>';
                                                }
                                            }
                                            ?>
                                        </small></p>
                                    <p class="card-text"><small class="text-muted fw-light"><?= date('F d, Y H:i:s', strtotime($review['tanggal_feedback'])); ?></small></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">No reviews available for this product.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <h1 class="text-center mt-5">Produk tidak tersedia.</h1>
    <div class="d-flex justify-content-center mt-5">
        <a href="<?= base_url('produk'); ?>" class="btn btn-primary btn-neoraised fw-bold">See Product Avaible</a>
    </div>
<?php endif; ?>