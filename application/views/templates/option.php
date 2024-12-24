<?php


if (empty($_SESSION)) {
    echo '<a class="dropdown-item fw-bold" href="login.php">Login</a>';
} else {
    $result = $conn->query("SELECT nama_admin FROM admin WHERE nama_admin = '$_SESSION[nama]'");
    if ($result->num_rows > 0) {
        echo '<a class="dropdown-item fw-bold" href="./assets/admin/dashboard.php">Dashboard</a>';
        echo '<a class="dropdown-item fw-bold" href="logout.php">Logout</a>';
    } else {
        echo '<a class="dropdown-item fw-bold" href="akun.php">Settings</a>';
        echo '<a class="dropdown-item fw-bold" href="chatting.php">Chat Admin</a>';
    }
}
