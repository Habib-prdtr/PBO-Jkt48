<?php 
if (!isset($_SESSION['login'])) {
  // Jika tidak, redirect ke halaman login
  header('Location: ../user/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembelian JKT48 Points</title>
  <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include 'navbar.php'; ?>
  <div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-md">
      <div class="bg-red-500 text-white text-center py-3 text-2xl font-bold w-full">
        Formulir Pembelian JKT48 Points
      </div>
      <p class="mt-4 text-sm text-gray-500">Bagian bertanda <span class="text-red-500">*</span> harus diisi</p>

      <form action="../admin/index.php?modul=topUp&fitur=add" method="post" class="mt-6 space-y-4">
        <div class="form-group">
          <label for="buy_points" class="block font-medium text-gray-700">Jumlah Points <span class="text-red-500">*</span></label>
          <select name="buy_points" id="buy_points" class="form-control mt-1 w-full p-2 border border-gray-300 rounded-lg" required>
            <option value="" label="----">----</option>
            <option value="20000" label="20,000 P">20,000 P</option>
            <option value="50000" label="50,000 P">50,000 P</option>
            <option value="100000" label="100,000 P">100,000 P</option>
            <option value="200000" label="200,000 P">200,000 P</option>
            <option value="300000" label="300,000 P">300,000 P</option>
            <option value="500000" label="500,000 P">500,000 P</option>
            <option value="1000000" label="1,000,000 P">1,000,000 P</option>
            <option value="2000000" label="2,000,000 P">2,000,000 P</option>
            <option value="3000000" label="3,000,000 P">3,000,000 P</option>
            <option value="5000000" label="5,000,000 P">5,000,000 P</option>
            <option value="10000000" label="10,000,000 P">10,000,000 P</option>
          </select>
          <span class="text-red-500 text-sm mt-2 block">Rp 1 = 1 P</span>
        </div>

        <div class="form-group">
          <label for="bayar" class="block font-medium text-gray-700">Bayar <span class="text-red-500">*</span></label>
          <input type="number" name="bayar" id="bayar" class="form-control mt-1 w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan jumlah bayar dalam Rupiah" required>
        </div>

        <div class="form-group">
          <label for="kembalian" class="block font-medium text-gray-700">Kembalian</label>
          <input type="text" name="kembalian" id="kembalian" class="form-control mt-1 w-full p-2 border border-gray-300 rounded-lg bg-gray-100" placeholder="Kembalian akan otomatis dihitung" readonly>
        </div>

        <div>
          <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg w-full hover:bg-pink-600">
            Konfirmasi
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const buyPoints = document.getElementById('buy_points');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');

    function calculateKembalian() {
      const selectedPoints = parseInt(buyPoints.value) || 0;
      const bayar = parseInt(bayarInput.value) || 0;

      if (bayar < selectedPoints) {
        kembalianInput.value = 'Rp 0'; // Menampilkan pesan jika bayar kurang
        return;
      }

      const kembalian = bayar - selectedPoints;
      kembalianInput.value = `Rp ${kembalian.toLocaleString()}`;
    }

    buyPoints.addEventListener('change', calculateKembalian);
    bayarInput.addEventListener('input', calculateKembalian);
  </script>
</body>
</html>
