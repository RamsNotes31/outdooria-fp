<?php
defined('BASEPATH') or
    header("Location: error");
?>

<script>
    <?php if (!$this->session->userdata('cek')): ?>
        Swal.fire({
            title: 'Selamat Datang!',
            text: 'Selamat datang kembali, <?php echo $this->session->userdata('nama'); ?>',
            icon: 'success',
            confirmButtonText: 'Oke'
        })
        <?php $this->session->set_userdata('cek', true); ?>
    <?php endif; ?>
</script>

<div class="container mt-4">
    <?php if ($this->session->userdata('nama')): ?>
        <h1 class="text-center fw-bolder mt-5 mb-5">Welcome back <span class="text-danger"><?php echo $this->session->userdata('nama'); ?>!</span></h1>
    <?php endif; ?>
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
                        $fullStars = $average_rating !== null ? floor($average_rating) : 0;
                        $halfStar = ($average_rating - $fullStars) >= 0.5;
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $fullStars) {
                                echo '<i class="bi bi-star-fill text-warning fs-1"></i>';
                            } elseif ($halfStar && $i == $fullStars + 1) {
                                echo '<i class="bi bi-star-half text-warning fs-1"></i>';
                            } else {
                                echo '<i class="bi bi-star text-muted fs-1"></i>';
                            }
                        }
                        ?>
                    </div>
                    <p class="text-center mt-2 fs-4 fw-light">(<?= $count_feedback; ?>) <?= $average_rating !== null ? number_format($average_rating, 1) : '0.0'; ?>/5.0</p>
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
                        <img src="https://fotomhs.amikom.ac.id/2023/23_12_2966.jpg" class="rounded-circle img-fluid img-thumbnail border border-dark border-3 card-neoraised" alt="Marcell" style="width: 10rem">
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

                                            <img src="<?= empty($feedback->foto_profil) ? base_url('public/img/user/deleted.jpg') : base_url('public/img/user/' . $feedback->foto_profil); ?>" \
                                                alt="<?= $feedback->nama_user; ?>" \
                                                class="rounded-circle me-2 mb-3 border border-2 border-dark card-neoraised"
                                                width="40" height="40">

                                            <a href="<?= base_url('akun/profil/' . ($feedback->nama_user)); ?>" class="d-flex align-items-center text-decoration-none">
                                                <h5 class="card-title fw-bold align-self-center"><?= htmlspecialchars($feedback->nama_user, ENT_QUOTES, 'UTF-8'); ?></h5>
                                            </a>


                                        </div>

                                        <p class="card-text fw-light mt-3">"<?= $feedback->komentar; ?>"</p>
                                        <?php if (!empty($feedback->foto)): ?>
                                            <?php if (file_exists(FCPATH . 'public/img/feedback/' . $feedback->foto)): ?>
                                                <img src="<?= base_url('public/img/feedback/' . $feedback->foto); ?>" class="img-fluid card-neoraised border border-dark border-1 rounded-3 mb-5" alt="Foto Feedback" width="150" height="150">
                                            <?php else: ?>
                                                <p class="card-text text-muted card card-neoraised p-1">Foto Telah dihapus.</p>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="d-block">

                                            <p class="card-text fw-light"><small
                                                    class="text-muted">
                                                    <?= date('F d, Y H:i:s', strtotime($feedback->tanggal_feedback)); ?>
                                                </small></p>

                                            <p class="card-text me-5"><small class="text-muted fw-bold"><?= $feedback->nama_alat; ?></small>
                                                <?php
                                                $rating = floor($feedback->rating);
                                                $hasHalfStar = ($feedback->rating - $rating) >= 0.5;

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
                                                ?><small class="text-muted fw-bold"> <?= number_format(htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'), 1); ?>/5.0</small></p>
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
            <h2 class="fw-bolder mt-5 text-center mb-5">Contact Info</h2><br>
            <p class="fw-light text-center">Location :
                Tridadi, Sleman Regency, Special Region of Yogyakarta.
                <br>
                <?php if (!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <hr>
            <div class="d-flex align-items-center justify-content-center mb-3">
           
                <img src="<?= base_url('public/img/admin/' . $admin->foto_admin); ?>"
                    alt="Admin Photo" class="rounded-circle img-fluid me-3 card-neoraised border border-dark border-1" width="30" height="30">
            
                <a href="<?= base_url('akun/admin/' . ($admin->nama_admin)); ?>" class="text-decoration-none">
                    <p class="fw-bold mb-0"><?php echo $admin->nama_admin; ?></p>
                </a>
            </div>


            <div class="text-center">
                <a href="mailto:<?php echo $admin->email_admin; ?>" class="text-decoration-none">
                    <i class="bi bi-envelope me-2 text-danger"></i><?php echo $admin->email_admin; ?>
                </a><br>


                <a href="tel:<?php echo $admin->no_telp_admin; ?>" class="text-decoration-none">
                    <i class="bi bi-telephone me-2 text-primary"></i><?php echo $admin->no_telp_admin; ?>
                </a><br>


                <a href="https://wa.me/+62<?php echo preg_replace('/^0/', '', $admin->no_telp_admin); ?>" class="text-decoration-none" target="_blank">
                    <i class="bi bi-whatsapp me-2 text-success"></i>+62<?php echo preg_replace('/^0/', '', $admin->no_telp_admin); ?>
                </a><br>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">No admin data available.</p>
    <?php endif; ?>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="text-center fw-bolder mt-5">Our Achievements</h1>
            <p class="text-center mt-4 fs-4 fw-light mb-5">We have a long history of success in mountain climbing. Here are some of our achievements</p>
            <div class="d-flex justify-content-center flex-lg-row flex-column">
                <div class="d-flex justify-content-center align-items-center mb-4 flex-lg-row flex-column gap-5">

                    <div class="card card-body border border-dark border-2 rounded-3 card-neoraised shadow-md">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <p class="text-center fs-1 fw-bolder text-danger"><?= $total_alat; ?>+</p>
                                <h1 class="text-center fs-3 fw-bolder text-success">Alat Tersedia</h1>

                            </div>

                        </div>
                    </div>

                    <div class="card card-body border border-dark border-2 rounded-3 card-neoraised shadow-md">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <p class="text-center fs-1 fw-bolder text-danger"><?= $total_users; ?>+</p>
                                <h1 class="text-center fs-3 fw-bolder text-success">User Mendaftar</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body border border-dark border-2 rounded-3 card-neoraised shadow-md">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <p class="text-center fs-1 fw-bolder text-danger"><?= $total_penyewaan; ?>+</p>
                                <h1 class="text-center fs-3 fw-bolder text-success">Total Penyewaan</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>