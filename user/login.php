<?php
// Mulai sesi untuk menyimpan data login pengguna
session_start();

require_once '../config/database.php'; // Ganti dengan path yang sesuai
require_once '../models/UserModel.php'; // Ganti dengan path yang sesuai

$userModel = new UserModel();

// Debug: Cek apakah form disubmit
if (isset($_POST['submit'])) {
    // Ambil data email dan password
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = false;

    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["login"] = true;
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["user_name"] = $user['nama'];
        $_SESSION["user_email"] = $user['email'];
        $_SESSION["user_oshimen"] = $user['namaOshimen'];
        header("Location: ../user/profile.php");
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-100">
<?php include 'navbar.php'; ?>
  <div class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row items-start space-y-6 md:space-y-0 md:space-x-6">
      <!-- Poster Gambar -->
      <div class="flex-1 bg-gray-200 rounded-lg p-4">
        <img src="../images/1.jpg" alt="Poster Login" class="rounded-lg shadow-md object-cover w-full h-full">
      </div>
      <!-- Form Login -->
      <div class="flex-1 max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold mb-6">Login</h2>
        <p class="text-red-800 mb-6">Bagian bertanda * harus diisi.</p>
        <?php if (isset($error) && $error): ?>
            <p style="color: red; text-align: center; font-style: italic;">Username atau Password salah!</p>
        <?php endif; ?>
        <form action="" method="post" class="space-y-6">
          <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Alamat email*</label>
              <input type="text" name="email" id="email" value="" class="w-full p-2 border border-gray-300 rounded-lg">
          </div>
          <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Kata sandi*</label>
              <input type="password" name="password" id="password" value="" class="w-full p-2 border border-gray-300 rounded-lg">
          </div>
          <div class="text-left">
              <a href="/reminder?lang=id" class="text-sm text-blue-500">Lupa password &gt;</a>
          </div>
          <div class="text-left">
              <a href="index.php?modul=user&fitur=input" class="text-sm text-blue-500">Bagi yang pertama kali &gt;</a>
          </div>
          <div class="text-left">
              <a href="fanclub.php" class="text-sm text-blue-500">Official Fans Club &gt;</a>
          </div>
          <button type="submit" name="submit" class="w-full py-3 text-white bg-red-500 hover:bg-pink-600 rounded-lg font-bold">Login</button>
      </form>
      </div>
    </div>
  </div>
</body>
</html>
