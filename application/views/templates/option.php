<?php
$CI = &get_instance();
$CI->load->library('session');

$role = $CI->session->userdata('role');

if (!$CI->session->userdata('logged_in')) : ?>

    <a class="dropdown-item fw-bold" href="<?php echo base_url('login'); ?>">Login</a>
<?php else : ?>

    <?php if ($role == 'admin') : ?>

        <a class="dropdown-item fw-bold" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        <a class="dropdown-item fw-bold" href="<?php echo base_url('logout'); ?>">Log Out</a>
    <?php elseif ($role == 'user') : ?>

        <a class="dropdown-item fw-bold" href="<?php echo base_url('logout'); ?>">Log Out</a>
        <a class="dropdown-item fw-bold" href="<?php echo base_url('akun'); ?>">Settings</a>
        <a class="dropdown-item fw-bold" href="<?php echo base_url('chatting'); ?>">Chat Admin</a>
    <?php endif; ?>
<?php endif; ?>