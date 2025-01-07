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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
<?php include 'navbar.php'; ?>
<div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mt-8 mb-4">Upgrade Keanggotaan JKT48 Official</h1>
    </div>
    <main class="py-8">
        <div class="container mx-auto px-4">
            <div class="post bg-white p-6 rounded-lg shadow-lg">
                <p>Terima kasih telah upgrade dari JKT48 Official Fan Club keanggotaan gratis.<br/>
                Bacalah ketentuan-ketentuan dibawah ini sebelum mendaftar.</p>

                <h3 class="mt-4 text-lg font-semibold">Yang harus dipersiapkan:</h3>
                <ol class="pl-4 list-decimal">
                    <li>Pas foto (tanpa background dan dapat dikenali)<br/><img class="m-2" src="https://jkt48.com/images/pic-fanclub1.png" alt="Contoh Pas Foto"></li>
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
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 JKT48 Fansite. All Rights Reserved.</p>
        </div>
    </footer>
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

</body>
</html>
