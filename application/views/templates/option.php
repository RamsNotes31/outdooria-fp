<?php
$CI = &get_instance(); // Mendapatkan instance CodeIgniter
$CI->load->library('session'); // Memastikan library session dimuat

$role = $CI->session->userdata('role'); // Mendapatkan role dari session

if (!$CI->session->userdata('logged_in')) : ?>
    <!-- Jika session kosong -->
    <a class="dropdown-item fw-bold" href="<?php echo base_url('login'); ?>">Login</a>
<?php else : ?>
    <!-- Jika session ada -->
    <?php if ($role == 'admin') : ?>
        <!-- Opsi untuk admin -->
        <a class="dropdown-item fw-bold" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        <a class="dropdown-item fw-bold" href="<?php echo base_url('logout'); ?>">Log Out</a>
    <?php elseif ($role == 'user') : ?>
        <!-- Opsi untuk user -->
        <a class="dropdown-item fw-bold" href="<?php echo base_url('logout'); ?>">Log Out</a>
        <a class="dropdown-item fw-bold" href="<?php echo base_url('akun'); ?>">Settings</a>
        <a class="dropdown-item fw-bold" href="<?php echo base_url('chatting'); ?>">Chat Admin</a>
    <?php endif; ?>
<?php endif; ?>