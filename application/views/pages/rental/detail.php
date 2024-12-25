<div class="container mt-5 py-5">
    <div class="row">
        <!-- Gambar dan Rating -->
        <div class="col-md-6 d-flex justify-content-center mb-5 align-items-center">
            <div class="row">
                <div class="col-md-12 px-5 text-center">
                    <img src="<?= base_url('public/img/produk/' . $product['foto_produk']); ?>" class="img-fluid border border-dark border-3 rounded-5 card-neoraised" alt="<?= $product['nama_alat']; ?>">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-danger btn-neoraised btn-lg mt-4 fw-bolder">
                            Add to Wishlist<i class="bi bi-heart-fill"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center flex-sm-row flex-column mt-5">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="d-flex">
                                <?php for ($i = 0; $i < floor($product['rata_rata_rating']); $i++): ?>
                                    <i class="bi bi-star-fill text-warning fs-1"></i>
                                <?php endfor; ?>
                                <?php if ($product['rata_rata_rating'] - floor($product['rata_rata_rating']) >= 0.5): ?>
                                    <i class="bi bi-star-half text-warning fs-1"></i>
                                <?php endif; ?>
                            </div>
                            <p class="text-center mt-2 fs-4 fw-bold"><?= number_format($product['rata_rata_rating'], 1); ?>/5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail dan Form -->
        <div class="col-md-6 align-items-center">
            <h2 class="text-center mb-5 fw-bolder">Booking Form</h2>
            <h3 class="card-title mt-md-3 fw-bolder mt-4 mb-3 text-left"><?= $product['nama_alat']; ?></h3>
            <p class="card-text fs-5 text-left">Rp. <?= number_format($product['harga_sewa'], 0, ',', '.'); ?> / Night</p>
            <p class="card-text fs-5 text-left fw-normal text-wrap">
                <strong>Deskripsi:</strong> <?= $product['deskripsi']; ?>
            </p>
            <h4 class="card-title mt-md-3 mb-4 text-left mt-3 fw-bold">
                Stok <span class="badge rounded-pill text-bg-success card-neoraised"><?= $product['stok']; ?></span>
            </h4>
            <form>
                <div class="mb-3">
                    <label for="bookingDate" class="form-label">Tanggal Pemesanan</label>
                    <input type="date" class="form-control card-neoraised" id="bookingDate" name="bookingDate" value="<?= date('Y-m-d'); ?>" required readonly>
                </div>
                <div class="mb-3">
                    <label for="returnDate" class="form-label">Tanggal Pengembalian</label>
                    <input type="date" class="form-control card-neoraised" id="returnDate" name="returnDate" value="<?= date('Y-m-d', strtotime('+2 days')); ?>" required readonly>
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
                    <a href="checkout.php" class="btn btn-warning btn-neoraised fw-bold">Booking Now</a>
                    <a href="<?= base_url('produk'); ?>" class="btn btn-primary btn-neoraised fw-bold">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container px-3">
    <div class="row py-5">
        <div class="col-lg-5 order-2 order-lg-1">
            <h2 class="text-center mb-4 mt-md-5 mt-5">Related Product</h2>
            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-6 col-sm-4 col-lg-6">
                            <div class="card card-neoraised py-2 px-2 mb-4">
                                <h3 class="card-title text-center mt-2 mb-3 fw-bold"><?= $product['nama_alat']; ?></h3>
                                <img src="<?= base_url('public/img/produk/' . $product['foto_produk']); ?>"
                                    class="img-fluid border border-dark border-3 rounded-3 card-neoraised"
                                    alt="<?= $product['nama_alat']; ?>">
                                <div class="d-flex justify-content-center mt-3 mb-md-2">
                                    <a href="<?= base_url('produk/detail/' . $product['id_alat']); ?>"
                                        class="btn btn-md btn-neoraised btn-primary mb-3 fw-bold">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada produk yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-7 order-1 order-lg-2">
            <h2 class="text-center mb-4 mt-md-5 mt-0 fw-bolder">Rating & Review</h2>
            <div class="rating-review-form">
                <form method="post" action="submit_review.php" class="mb-4">
                    <div class="form-group">
                        <label for="userRating" class="form-label">Your Rating:</label>
                        <select id="userRating" name="rating" class="form-control card-neoraised" required>
                            <option value="" disabled selected>Choose Rating</option>
                            <option value="5">5 - Excellent</option>
                            <option value="4.5">4.5 - Very Good</option>
                            <option value="4">4 - Very Good</option>
                            <option value="3.5">3.5 - Good</option>
                            <option value="3">3 - Good</option>
                            <option value="2.5">2.5 - Fair</option>
                            <option value="2">2 - Fair</option>
                            <option value="1.5">1.5 - Poor</option>
                            <option value="1">1 - Poor</option>
                        </select>
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

                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="card card-neoraised p-3 mb-3">
                            <div class="d-flex">
                                <!-- Gambar User (dapat disesuaikan dengan gambar pengguna yang terhubung) -->
                                <img src="<?= base_url('public/img/user/' . $review['foto_profil']); ?>" alt="<?= $review['nama']; ?>" class="rounded-circle me-2 mb-3 border border-2 border-dark card-neoraised" width="40" height="40">
                                <h5 class="card-title fw-bold align-self-center"><?= $review['nama']; ?></h5>
                            </div>
                            <p class="card-text"><?= '"' . htmlspecialchars($review['komentar']) . '"'; ?></p>
                            <div class="d-flex justify-content-between">
                                <p class="card-text"><small class="text-muted">
                                        <?php
                                        // Menampilkan bintang berdasarkan rating
                                        for ($i = 1; $i <= $review['rating']; $i++) {
                                            echo '<i class="bi bi-star-fill text-warning"></i>';
                                        }
                                        // Jika rating kurang dari 5, tambahkan setengah bintang
                                        if ($review['rating'] < 5) {
                                            echo '<i class="bi bi-star-half text-warning"></i>';
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