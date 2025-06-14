<?php 
if (!isset($_SESSION['login'])) {
  // Jika tidak, redirect ke halaman login
  header('Location: ../user/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembelian JKT48 Points</title>
  <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'jkt-red': '#E60000',
            'jkt-gold': '#FFD700',
          },
        },
      },
    }
  </script>
</head>
<body class="bg-gradient-to-br from-red-50 to-red-100 min-h-screen flex flex-col">
  <?php include 'navbar.php'; ?>
  <div class="container mx-auto p-4 sm:p-6 md:p-8 lg:p-10 mt-8">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-2xl mx-auto">
      <div class="bg-gradient-to-r from-jkt-red to-red-600 text-white text-center py-4 sm:py-6 px-4">
        <h1 class="text-2xl sm:text-3xl font-bold mb-2">Pembelian JKT48 Points</h1>
      </div>
      
      <div class="p-4 sm:p-6 md:p-8">
        <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6">Bagian bertanda <span class="text-jkt-red">*</span> harus diisi</p>

        <form action="../admin/index.php?modul=topUp&fitur=add" method="post" class="space-y-4 sm:space-y-6">
          <div class="form-control">
            <label for="buy_points" class="label">
              <span class="label-text font-medium text-gray-700">Jumlah Points <span class="text-jkt-red">*</span></span>
            </label>
            <select name="buy_points" id="buy_points" class="select select-bordered w-full" required>
              <option value="" disabled selected>Pilih jumlah points</option>
              <option value="20000">20,000 P</option>
              <option value="50000">50,000 P</option>
              <option value="100000">100,000 P</option>
              <option value="200000">200,000 P</option>
              <option value="300000">300,000 P</option>
              <option value="500000">500,000 P</option>
              <option value="1000000">1,000,000 P</option>
              <option value="2000000">2,000,000 P</option>
              <option value="3000000">3,000,000 P</option>
              <option value="5000000">5,000,000 P</option>
              <option value="10000000">10,000,000 P</option>
            </select>
            <span class="text-jkt-red text-xs sm:text-sm mt-2 block">Rp 1 = 1 P</span>
          </div>

          <div class="form-control">
            <label for="bayar" class="label">
              <span class="label-text font-medium text-gray-700">Bayar <span class="text-jkt-red">*</span></span>
            </label>
            <input type="number" name="bayar" id="bayar" class="input input-bordered w-full" placeholder="Masukkan jumlah bayar dalam Rupiah" required>
          </div>

          <div class="form-control">
            <label for="kembalian" class="label">
              <span class="label-text font-medium text-gray-700">Kembalian</span>
            </label>
            <input type="text" name="kembalian" id="kembalian" class="input input-bordered w-full bg-gray-100" placeholder="Kembalian akan otomatis dihitung" readonly>
          </div>

          <div>
            <button type="submit" class="btn btn-primary w-full bg-jkt-red hover:bg-red-700 border-none">
              Konfirmasi Pembelian
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="bg-gray-900 text-white py-4 mt-auto" style="overflow: hidden;">
    <div class="container mx-auto text-center">
      <p class="text-jkt-gold font-semibold">&copy; 2024 JKT48 Official Fansite</p>
      <a href="https://www.instagram.com/habib_prdtr" target="_blank"><i class="fab fa-instagram"></i> Author</a>
      <p class="mt-2 text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
    </div>
  </footer>

  <script>
    const buyPoints = document.getElementById('buy_points');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');

    function calculateKembalian() {
      const selectedPoints = parseInt(buyPoints.value) || 0;
      const bayar = parseInt(bayarInput.value) || 0;

      if (bayar < selectedPoints) {
        kembalianInput.value = 'Pembayaran kurang';
        return;
      }

      const kembalian = bayar - selectedPoints;
      kembalianInput.value = `Rp ${kembalian.toLocaleString()}`;
    }

    buyPoints.addEventListener('change', calculateKembalian);
    bayarInput.addEventListener('input', calculateKembalian);
  </script>
  <div id="toast-container" class="fixed bottom-5 right-5 space-y-2 z-50"></div>
</body>
<script src="../includes/notifikasi.js"></script>
</html>
