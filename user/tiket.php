<?php 
if (!isset($_SESSION['login'])) {
    // Jika tidak, redirect ke halaman login
    header('Location: ../user/login.php');
    exit;
}

$obj_user = new UserModel();

// Ambil tipe user berdasarkan user yang sedang login
$userId = $_SESSION['user_id'];
$user = $obj_user->getUserById($userId);

// Ambil data event berdasarkan id dari parameter URL

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pembelian Tiket Event - JKT48</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .section-title {
            border-bottom: 4px solid #FF6F61;
            display: inline-block;
            padding-bottom: 2px;
            margin-bottom: 16px;
            color: #FF6F61;
            text-align: center;
        }
        .label-container {
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 8px;
            margin-bottom: 16px;
        }
        .form-control:focus {
            border-color: #FF6F61;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 111, 97, 0.5);
        }
        .event-image {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <?php include 'navbar.php'; ?>

    <main class="py-12">
        <div class="container mx-auto px-6">
        <h2 class="section-title text-3xl font-semibold mb-8 text-center flex items-center justify-center space-x-4">
        <i class="fa-solid fa-ticket"></i>
    <span>Formulir Pembelian Tiket Event</span>
</h2>
            
            <!-- Foto Event -->
            <div class="mb-8 flex justify-center">
    <img src="../images/event/<?= $event['foto']; ?>" alt="Foto Event" class="event-image max-w-md border-4 border-gray-300 rounded-xl shadow-2xl transform hover:scale-110 hover:rotate-3 transition-all duration-300 ease-in-out">
</div>

<div class="bg-white rounded-lg shadow-xl p-10 max-w-5xl mx-auto">
    <form action="../user/index.php?modul=transaksi&fitur=add" method="post">
        <input type="hidden" name="event_id" value="<?= $event['id']; ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="label-container">
                <label class="block font-medium text-gray-700">Nama Event</label>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($event['nama']); ?></p>
            </div>

            <div class="label-container">
                <label class="block font-medium text-gray-700">Tanggal</label>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($event['tanggal']); ?></p>
            </div>

            <div class="label-container">
                <label class="block font-medium text-gray-700">Tempat</label>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($event['tempat']); ?></p>
            </div>

            <div class="label-container">
                <label class="block font-medium text-gray-700">Harga Tiket</label>
                <p class="text-lg font-semibold text-gray-900">Rp <?= number_format($event['harga'], 0, ',', '.'); ?></p>
            </div>

            <div class="label-container">
                <label class="block font-medium text-gray-700">Stok Tiket</label>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($event['stok']); ?></p>
            </div>

            <div class="label-container">
                <label class="block font-medium text-gray-700">Tipe Event</label>
                <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($event['tipeEvent']); ?></p>
            </div>
        </div>

        <!-- Menampilkan saldo saat ini -->
        <div class="mt-8 label-container">
            <label class="block font-medium text-gray-700">Saldo Saat Ini</label>
            <p class="text-lg font-semibold text-gray-900">Rp <?= number_format($user['saldo'], 0, ',', '.'); ?></p>
        </div>

        <div class="mt-8 label-container">
            <label for="jumlahTiket" class="block font-medium text-gray-700">Jumlah Tiket <span class="text-red-500">*</span></label>
            <input type="number" name="jumlahTiket" id="jumlahTiket" class="form-control mt-2 w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Masukkan jumlah tiket yang ingin dibeli" min="1" max="<?= $event['stok']; ?>" required>
        </div>

        <div class="mt-6 label-container">
            <label for="totalHarga" class="block font-medium text-gray-700">Total Harga</label>
            <input type="text" name="totalHarga" id="totalHarga" class="form-control mt-2 w-full p-4 border border-gray-300 rounded-lg bg-gray-100 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" readonly>
        </div>

        <div class="mt-6 label-container">
            <label for="kembalian" class="block font-medium text-gray-700">Kembalian</label>
            <input type="text" name="kembalian" id="kembalian" class="form-control mt-2 w-full p-4 border border-gray-300 rounded-lg bg-gray-100 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" readonly>
        </div>

        <input type="hidden" name="bayar" id="bayar">

        <div class="mt-10">
            <button type="submit" class="bg-red-500 text-white py-4 px-8 rounded-lg w-full font-semibold text-lg shadow-md hover:bg-red-600 transition ease-in-out duration-300">
                Konfirmasi Pembelian
            </button>
        </div>
    </form>
</div>

        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 JKT48 Fansite. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        const jumlahTiketInput = document.getElementById('jumlahTiket');
        const totalHargaInput = document.getElementById('totalHarga');
        const kembalianInput = document.getElementById('kembalian');
        const hargaTiket = <?= $event['harga']; ?>;
        const saldoUser = <?= $user['saldo']; ?>;
        const bayarInput = document.getElementById('bayar');
            
        function updateTotalHarga() {
            const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
            const totalHarga = jumlahTiket * hargaTiket;
            totalHargaInput.value = totalHarga;  // Tidak ada format "Rp"
            bayarInput.value = totalHarga; // Inisialisasi bayar dengan totalHarga
            const kembalian = saldoUser - totalHarga;
            kembalianInput.value = kembalian; // Tidak ada format "Rp"
        }

        jumlahTiketInput.addEventListener('input', updateTotalHarga);

    </script>
</body>
</html>
