<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-6 d-flex align-items-center">
            <img src="<?php echo base_url("public/img/gunung.png"); ?>" alt="Gunung" class="img-fluid mx-auto">
        </div>
        <div class="col-lg-6 d-flex align-items-center">
            <div class="bs-component text-center">
                <h1 class="fs-1 lh-md fw-bolder display-1 mt-5">
                    Your solution to mountain climbing.
                </h1>
                <p class="mt-4 fs-2 fw-light lh-md">Experience the thrill and adventure of mountain climbing with us.
                </p>
                <?php $this->load->view('templates/opsi'); ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <h2 class="text-center fw-bolder">Our Service</h2>
            <p class="text-center mt-4 fs-4 fw-light">We provide a series of services to help you prepare for your mountain climbing adventure.</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item fw-bold">Mountain Climbing Equipment Rental</li>
                <li class="list-group-item fw-bold">Spot Hiking Information</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h2 class="text-center mt-md-0 mt-5 fw-bolder">Average Ratings</h2>
            <div class="d-flex justify-content-center flex-sm-row flex-column">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <div class="d-flex">
                        <?php
                        // Menampilkan bintang berdasarkan rata-rata rating
                        $fullStars = floor($average_rating); // Jumlah bintang penuh
                        $halfStar = ($average_rating - $fullStars) >= 0.5 ? true : false; // Cek jika ada bintang setengah
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $fullStars) {
                                echo '<i class="bi bi-star-fill text-warning fs-1"></i>'; // Bintang penuh
                            } elseif ($halfStar && $i == $fullStars + 1) {
                                echo '<i class="bi bi-star-half text-warning fs-1"></i>'; // Bintang setengah
                            } else {
                                echo '<i class="bi bi-star text-muted fs-1"></i>'; // Bintang kosong
                            }
                        }
                        ?>
                    </div>
                    <p class="text-center mt-2 fs-4 fw-light"><?= number_format($average_rating, 1); ?>/5</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="text-center fw-bolder">Our Team</h1>
            <p class="text-center mt-4 fs-4 fw-light">Our team consists of experienced mountain climbers who are passionate about helping others to reach the summit of their dreams.</p>
            <div class="d-flex justify-content-center flex-lg-row flex-column">
                <div class="d-flex justify-content-center align-items-center mb-4 flex-lg-row flex-column">
                    <div class="d-flex flex-column align-items-center mx-4">
                        <img src="https://fotomhs.amikom.ac.id/2023/23_12_2962.jpg" class="rounded-circle img-fluid img-thumbnail border border-dark border-3 card-neoraised" alt="Marcell" style="width: 10rem">
                        <p class="text-center fs-1 fw-bolder">Marcell</p>
                        <div class="alert alert-danger-neoraised alert-danger fw-bolder" role="alert">
                            23.12.2966
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mx-4">
                        <img src="https://fotomhs.amikom.ac.id/2023/23_12_2956.jpg" class="rounded-circle img-fluid img-thumbnail border border-dark border-3 card-neoraised" alt="Rama" style="width: 10rem">
                        <p class="text-center fs-1 fw-bolder">Rama</p>
                        <div class="alert alert-danger-neoraised alert-danger fw-bolder" role="alert">
                            23.12.2956
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mx-4">
                        <img src="https://fotomhs.amikom.ac.id/2023/23_12_2925.jpg" class="rounded-circle img-fluid img-thumbnail border border-dark border-3 card-neoraised" alt="Panji" style="width: 10rem">
                        <p class="text-center fs-1 fw-bolder">Panji</p>
                        <div class="alert alert-danger-neoraised alert-danger fw-bolder" role="alert">
                            23.12.2925
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mx-4">
                        <img src="https://fotomhs.amikom.ac.id/2023/23_12_2973.jpg" class="rounded-circle img-fluid img-thumbnail border border-dark border-3 card-neoraised" alt="Fahmi" style="width: 10rem">
                        <p class="text-center fs-1 fw-bolder">Fahmi</p>
                        <div class="alert alert-danger-neoraised alert-danger fw-bolder" role="alert">
                            23.12.2973
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center mt-5 fw-bolder">Our Feedback</h1>
    <p class="text-center mt-4 mb-4 fs-4 fw-light">This is what our customers say about our services and products.</p>

    <div class="px-3 py-3">
        <div class="row">
            <div class="container">
                <div class="row">
                    <?php if (!empty($feedbacks)): ?>
                        <?php foreach ($feedbacks as $feedback): ?>
                            <div class="col-12">
                                <div class="card card-neoraised mb-3">
                                    <div class="mx-3 my-3">
                                        <div class="d-flex justify-space-between">
                                            <!-- Gambar Profil Placeholder -->
                                            <img src="<?= base_url('public/img/user/' . $feedback->foto_profil); ?>" \
                                                alt="<?= $feedback->nama_user; ?>"
                                                class="rounded-circle me-2 mb-3 border border-2 border-dark card-neoraised"
                                                width="40" height="40">
                                            <!-- Nama User -->
                                            <h5 class="card-title fw-bold align-self-center"><?= $feedback->nama_user; ?></h5>
                                        </div>
                                        <!-- Komentar -->
                                        <p class="card-text fw-light">"<?= $feedback->komentar; ?>"</p>
                                        <div class="d-block">
                                            <!-- Tanggal Feedback -->
                                            <p class="card-text fw-light"><small
                                                    class="text-muted"><?= $feedback->tanggal_feedback; ?></small></p>
                                            <!-- Nama Alat dan Rating -->
                                            <p class="card-text me-5"><small class="text-muted fw-bold"><?= $feedback->nama_alat; ?></small>
                                                <?php
                                                $rating = floor($feedback->rating); // Ambil nilai bulat bawah dari rating
                                                $hasHalfStar = ($feedback->rating - $rating) >= 0.5; // Cek apakah ada setengah bintang

                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating) {
                                                        echo '<i class="bi bi-star-fill text-warning"></i>'; // Bintang penuh
                                                    } elseif ($hasHalfStar && $i == $rating + 1) {
                                                        echo '<i class="bi bi-star-half text-warning"></i>'; // Bintang setengah
                                                        $hasHalfStar = false; // Set sudah digunakan
                                                    } else {
                                                        echo '<i class="bi bi-star text-muted"></i>'; // Bintang kosong
                                                    }
                                                }
                                                ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">No feedback data available.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-9">
            <h1 class="text-center mt-5 fw-bolder mb-5">Visit Our Store</h1>
            <div class="map-container card-neoraised border border-dark border-2 rounded-3" style="position: relative; padding-bottom: 70.25%; height: 0; overflow: hidden;">
                <iframe src="https://www.google.com/maps/embed/v1/place?q=-7.720941,+110.365193&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                    width="600"
                    height="450"
                    style="border:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                    allowfullscreen ""
                    loading="lazy">
                    <style>
                        #google-maps-display img {
                            max-width: none !important;
                            background: none !important;
                            font-size: inherit;
                            font-weight: inherit;
                        }
                    </style>
                </iframe>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <h2 class="fw-bolder mt-5 text-center mb-5">Contact Info</h2>
            <p class="fw-light text-center">Location :
                Tridadi, Sleman Regency, Special Region of Yogyakarta.
                <br><br>
                <?php if (!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <hr>
            <div class="d-flex align-items-center justify-content-center mb-3">
                <!-- Display Admin Photo -->
                <img src="<?= base_url('public/img/admin/' . $admin->foto_admin); ?>"
                    alt="Admin Photo" class="rounded-circle img-fluid me-3 card-neoraised border border-dark border-1" width="30" height="30">
                <!-- Display Admin Name -->
                <p class="fw-bold mb-0"><?php echo $admin->nama_admin; ?></p>
            </div>

            <!-- Display Admin Email -->
            <div class="text-center">
                <a href="mailto:<?php echo $admin->email_admin; ?>" class="text-decoration-none">
                    <i class="bi bi-envelope me-2 text-danger"></i><?php echo $admin->email_admin; ?>
                </a><br>

                <!-- Display Admin Phone Number -->
                <a href="tel:<?php echo $admin->no_telp_admin; ?>" class="text-decoration-none">
                    <i class="bi bi-telephone me-2 text-primary"></i><?php echo $admin->no_telp_admin; ?>
                </a><br>

                <!-- Display Admin WhatsApp Link -->
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $admin->no_telp_admin); ?>" class="text-decoration-none">
                    <i class="bi bi-whatsapp me-2 text-success"></i>+<?php echo $admin->no_telp_admin; ?>
                </a><br>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">No admin data available.</p>
    <?php endif; ?>
        </div>
    </div>
</div>