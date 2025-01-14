<?php
session_start();
session_unset(); // Hapus semua data session
session_destroy(); // Hancurkan session

// Hapus cookie dengan menetapkan masa berlaku di masa lalu
setcookie('user_id', '', time() - 3600, "/"); // Hapus cookie user_id
setcookie('user_name', '', time() - 3600, "/"); // Hapus cookie user_name

// Redirect ke halaman login
header('Location: ../user/login.php');
exit;
?>
