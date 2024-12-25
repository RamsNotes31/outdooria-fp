<?php


if (empty($_SESSION)) {
    // echo '<a class="dropdown-item fw-bold" href="' . base_url("login") . '">Login</a>';
    echo '<a class="dropdown-item fw-bold" href="' . base_url("dashboard") . '">Dashboard</a>';
    echo '<a class="dropdown-item fw-bold" href="' . base_url("logout") . '">Log Out</a>';
} else {
    $result = $conn->query("SELECT nama_admin FROM admin WHERE nama_admin = '$_SESSION[nama]'");
    if ($result->num_rows > 0) {
        echo '<a class="dropdown-item fw-bold" href="' . base_url("dashboard") . '">Dashboard</a>';
        echo '<a class="dropdown-item fw-bold" href="' . base_url("logout") . '">Log Out</a>';
    } else {
        echo '<a class="dropdown-item fw-bold" href="akun.php">Settings</a>';
        echo '<a class="dropdown-item fw-bold" href="chatting.php">Chat Admin</a>';
    }
}
