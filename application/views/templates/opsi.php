<?php
$CI = &get_instance(); // Mendapatkan instance CodeIgniter
$CI->load->library('session');
if (!$CI->session->userdata('logged_in')) : ?>
    <!-- Jika session kosong -->
    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url('login'); ?>" class="btn btn-lg btn-neoraised btn-primary px-4 py-2 fw-bolder">Login</a>
    </div>
<?php else : ?>
    <!-- Jika session ada -->
    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url('produk'); ?>" class="btn btn-lg btn-neoraised btn-warning px-4 py-2 fw-bolder">Get Started</a>
    </div>
<?php endif; ?>