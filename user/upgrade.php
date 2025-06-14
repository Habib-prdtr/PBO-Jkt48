<?php
 // Pastikan file model UserModel disertakan
 
 if (!isset($_SESSION['login'])) {
   // Jika tidak, redirect ke halaman login
   header('Location: ../user/login.php');
   exit;
 }
 
$obj_user = new UserModel();

// Ambil tipe user berdasarkan user yang sedang login
$userId = $_SESSION['user_id'];
$user = $obj_user->getUserById($userId);

// Jika tipe user adalah OFC, redirect ke halaman profil
if ($user['tipeUser'] === 'OFC') {
    echo "<script>alert('Anda sudah memiliki tipe user OFC. Halaman ini tidak dapat diakses.');</script>";
    echo "<script>window.location.href='profile.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade Keanggotaan JKT48 Official</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body class="bg-gray-100 text-gray-800">
<?php include 'navbar.php'; ?>
<div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mt-8 mb-1">Upgrade Keanggotaan JKT48 Official</h1>
    </div>
    <main class="py-8 sm:ml-4 sm:mr-4 md:ml-20 md:mr-20">
        <div class="container mx-auto px-4">
            <div class="post bg-white p-6 rounded-lg shadow-lg">
                <p>Terima kasih telah upgrade dari JKT48 Official Fan Club keanggotaan gratis.<br/>
                Bacalah ketentuan-ketentuan dibawah ini sebelum mendaftar.</p>

                <h3 class="mt-4 text-lg font-semibold">Yang harus dipersiapkan:</h3>
                <ol class="pl-4 list-decimal">
                    <li>Uang pendaftaran: Rp100.000,- Iuran OFC: Rp200.000, = Total Rp300.000,-</li>
                </ol>

                <form action="index.php?modul=user&fitur=upgradeTipeUser" method="post" enctype="multipart/form-data">

                    <div class="form-group mt-4">
                        <label class="block font-medium text-gray-700">Saldo JKTPoint Saat Ini</label>
                        <p id="saldoJktPoint" class="text-gray-900 font-semibold">Rp <?php echo number_format($saldo, 0, ',', '.'); ?></p>
                    </div>

                    <div class="form-group mt-4">
                        <label for="kembalian" class="block font-medium text-gray-700">Sisa Saldo</label>
                        <input type="text" name="kembalian" id="kembalian" class="form-control mt-1 w-full p-2 border border-gray-300 rounded-lg bg-gray-100" placeholder="Kembalian akan otomatis dihitung" readonly>
                    </div>

                    <div class="form-group mt-4">
                        <label class="block font-medium text-gray-700">Total Harga</label>
                        <p id="totalHarga" class="text-gray-900 font-semibold">Rp 300.000,-</p>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg w-full hover:bg-red-600">
                            Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <script>
    const saldoJktPoint = <?php echo $saldo; ?>;
    const kembalianInput = document.getElementById('kembalian');
    const totalHarga = 300000;

    function calculateKembalian() {
        // Hitung kembalian berdasarkan saldo
        const kembalian = saldoJktPoint - totalHarga;

        // Tampilkan kembalian
        kembalianInput.value = kembalian >= 0 ? `Rp ${kembalian.toLocaleString()}` : 'Rp 0';
    }

    // Panggil fungsi untuk langsung menghitung kembalian saat halaman dimuat
    calculateKembalian();
</script>
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
