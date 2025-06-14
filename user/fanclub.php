<?php
session_start();

require_once '../config/database.php'; // Ganti dengan path yang sesuai
require_once '../models/UserModel.php'; // Ganti dengan path yang sesuai

// Cek jika session user_id ada
if (isset($_SESSION['user_id'])) {
    // Jika session ada, ambil data pengguna
    $user_id = $_SESSION['user_id'];
    $userModel = new UserModel();
    $user = $userModel->getUserById($user_id);

    if (!$user) {
        // Jika data pengguna tidak ditemukan, tampilkan pesan error
        echo "Data pengguna tidak ditemukan.";
        exit;
    }
} else {
    // Jika session tidak ada, tentukan pengguna sebagai null atau tampilkan pesan
    $user = null;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JKT48 Fan Club</title>
  <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
  <script>
      tailwind.config = {
          theme: {
              extend: {
                  colors: {
                      'jkt-gold': '#FFD700',
                  },
              },
          },
      };
  </script>
</head>
<body class="bg-gray-100">
<?php include 'navbar.php'; ?>
  <!-- Hero Section -->
  <div class="entry-fanclub2024__hero hidden lg:block">
    <img src="https://jkt48.com/assets/fanclub/hero-fanclub-pc.jpg" alt="Fanclub Hero PC" class="w-full">
  </div>
  <div class="entry-fanclub2024__hero block lg:hidden">
    <img src="https://jkt48.com/assets/fanclub/hero-fanclub-sp.jpg" alt="Fanclub Hero SP" class="w-full">
  </div>

  <!-- Section: Header -->
  <div class="bg-red-500 text-white py-6">
    <h1 class="text-center text-3xl font-bold">OFFICIAL FAN CLUB MEMBERSHIP RENEWAL 2024</h1>
    <p class="text-center mt-4 px-6 max-w-4xl mx-auto font-medium">
      Bergabunglah menjadi anggota JKT48 Official Fans Club (OFC)! Pada program JKT48 OFC Renewal 2024 ini, banyak benefit yang bisa kamu dapatkan! Kamu bisa menghadiri event khusus OFC, melakukan pemesanan tiket lebih awal dari non-OFC, dan banyak benefit lainnya. Silakan scroll ke bawah untuk info lebih lanjut!
    </p>
  </div>

  <!-- Section: Benefits -->
  <section class="py-12 bg-white">
    <h2 class="text-2xl text-center font-bold mb-8">BENEFITS</h2>
    <div class="container mx-auto flex justify-center items-center">
      <!-- Benefit Item -->
      <div class="bg-gray-50 rounded-lg shadow-lg overflow-hidden w-full max-w-sm">
        <img src="https://jkt48.com/assets/fanclub/benefits-image03.png" alt="Benefit 2" class="w-full">
        <div class="p-4 text-center">
          <h3 class="font-bold text-lg">Event Spesial OFC, Online dan Offline</h3>
          <p class="text-gray-700 mt-2">
            Akan ada beberapa event spesial yang hanya dapat diikuti oleh kalian! Sebelumnya pernah dilakukan event membatik, main futsal, membuat pizza, dan banyak keseruan lainnya. Tunggu info lebih lanjut ya!
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section: Sign Up -->
  <section class="py-12 bg-gray-100">
    <h2 class="text-2xl text-center font-bold mb-8">SIGN UP!</h2>
    <div class="container mx-auto max-w-lg">
      <?php if ($user): ?>
        <!-- If user is logged in, show upgrade option -->
        <a href="index.php?modul=user&fitur=editTipeUser&id=<?php echo $user['id']; ?>" class="block bg-red-500 text-white text-center py-3 rounded-lg hover:bg-red-600">
          Upgrade Membership
        </a>
      <?php else: ?>
        <!-- If user is not logged in, show sign up option -->
        <a href="index.php?modul=user&fitur=input" class="block bg-red-500 text-white text-center py-3 rounded-lg mb-4 hover:bg-red-600">
          Sign Up
        </a>
      <?php endif; ?>
    </div>
  </section>
  <footer class="bg-gray-900 text-white py-4 mt-10" style="overflow: hidden;">
        <div class="container mx-auto text-center">
            <p class="text-jkt-gold font-semibold">&copy; 2024 JKT48 Official Fansite</p>
            <a href="https://www.instagram.com/habib_prdtr" target="_blank"><i class="fab fa-instagram"></i> Author</a>
            <p class="mt-2 text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
        </div>
    </footer>
    <div id="toast-container" class="fixed bottom-5 right-5 space-y-2 z-50"></div>
</body>
<script src="../includes/notifikasi.js"></script>
</html>
