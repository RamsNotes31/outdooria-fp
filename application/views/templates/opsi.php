<?php
$CI = &get_instance();
$CI->load->library('session');
if (!$CI->session->userdata('logged_in')) : ?>

    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url('login'); ?>" class="btn btn-lg btn-neoraised btn-primary px-4 py-2 fw-bolder">Login</a>
    </div>
<?php else : ?>

    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url('produk'); ?>" class="btn btn-lg btn-neoraised btn-warning px-4 py-2 fw-bolder">Get Started</a>
    </div>
<?php endif; ?>