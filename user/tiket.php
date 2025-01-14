<?php 
if (!isset($_SESSION['login'])) {
    header('Location: ../user/login.php');
    exit;
}

$obj_user = new UserModel();
$userId = $_SESSION['user_id'];
$user = $obj_user->getUserById($userId);

// Ambil data event berdasarkan id dari parameter URL
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Tiket Event</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-red': '#FF3131',
                        'custom-dark-red': '#B22222',
                        'jkt-gold': '#FFD700',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-red-100 to-red-200 min-h-screen">
    <?php include 'navbar.php'; ?>
    <div class="container mx-auto px-4 sm:px-6 lg:px-14 py-8">
        <div class="card bg-white shadow-xl overflow-hidden">
            <figure class="relative">
                <img src="../images/event/<?= $event['foto']; ?>" alt="Event Poster" class="w-full h-56 md:h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                <h1 class="absolute bottom-4 left-4 text-2xl sm:text-3xl md:text-5xl font-bold text-white drop-shadow-lg">
                    <?= htmlspecialchars($event['nama']); ?>
                </h1>
            </figure>
            <div class="card-body bg-white p-4 sm:p-6">
            <div class="grid grid-cols-3 gap-2 sm:gap-4">
            <div class="card bg-red-500 text-white shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="card-body p-2 sm:p-4 flex flex-col items-center justify-center text-center">
                    <i class="fas fa-calendar-alt text-xl sm:text-3xl mb-1 sm:mb-2"></i>
                    <h2 class="card-title text-xs sm:text-lg">Tanggal</h2>
                    <p class="text-xs sm:text-sm"><?= htmlspecialchars($event['tanggal']); ?></p>
                </div>
            </div>
            <a href="https://www.google.com/maps/search/<?= urlencode($event['tempat']); ?>" 
               target="_blank" 
               class="block transform hover:scale-105 transition-transform duration-300">
                <div class="card bg-red-600 text-white shadow-lg h-full">
                    <div class="card-body p-2 sm:p-4 flex flex-col items-center justify-center text-center">
                        <i class="fas fa-map-marker-alt text-xl sm:text-3xl mb-1 sm:mb-2"></i>
                        <h2 class="card-title text-xs sm:text-lg">Tempat</h2>
                        <p class="text-xs sm:text-sm"><?= htmlspecialchars($event['tempat']); ?></p>
                    </div>
                </div>
            </a>
            <div class="card bg-red-700 text-white shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="card-body p-2 sm:p-4 flex flex-col items-center justify-center text-center">
                    <i class="fas fa-ticket-alt text-xl sm:text-3xl mb-1 sm:mb-2"></i>
                    <h2 class="card-title text-xs sm:text-lg">Harga Tiket</h2>
                    <p class="text-xs sm:text-sm">Rp <?= number_format($event['harga'], 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
                <div class="mt-6 flex flex-col sm:flex-row sm:justify-between items-start sm:items-center bg-gray-100 p-4 rounded-lg gap-4 sm:gap-0">
                    <div class="flex items-center">
                        <i class="fas fa-layer-group text-2xl sm:text-4xl text-custom-red mr-3"></i>
                        <div>
                            <h3 class="font-bold text-gray-700 text-sm sm:text-base">Stok Tiket</h3>
                            <p class="text-sm sm:text-lg text-custom-red"><?= htmlspecialchars($event['stok']); ?> tiket</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-music text-2xl sm:text-4xl text-custom-red mr-3"></i>
                        <div>
                            <h3 class="font-bold text-gray-700 text-sm sm:text-base">Tipe Event</h3>
                            <p class="text-sm sm:text-lg text-custom-red"><?= htmlspecialchars($event['tipeEvent']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 sm:p-6 bg-white">
                <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-custom-dark-red">Pembelian Tiket</h2>
                <form action="../user/index.php?modul=transaksi&fitur=add" method="post">
                    <input type="hidden" name="event_id" value="<?= $event['id']; ?>">
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text text-custom-dark-red font-semibold">Saldo Saat Ini</span></label>
                            <input type="text" value="Rp <?= number_format($user['saldo'], 0, ',', '.'); ?>" class="input input-bordered border-custom-red w-full" readonly />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text text-custom-dark-red font-semibold">Jumlah Tiket</span></label>
                            <input type="number" name="jumlahTiket" id="jumlahTiket" class="input input-bordered border-custom-red w-full" placeholder="0" min="1" max="<?= $event['stok']; ?>" required />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text text-custom-dark-red font-semibold">Total Harga</span></label>
                            <input type="text" name="totalHarga" id="totalHarga" class="input input-bordered border-custom-red w-full" placeholder="Rp 0" readonly />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text text-custom-dark-red font-semibold">Kembalian</span></label>
                            <input type="text" name="kembalian" id="kembalian" class="input input-bordered border-custom-red w-full" placeholder="Rp 0" readonly />
                        </div>

                        <input type="hidden" name="bayar" id="bayar">

                        <button type="submit" class="btn btn-block bg-custom-red hover:bg-custom-dark-red text-white text-lg">Beli Tiket Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    <footer class="bg-gray-900 text-white py-4 mt-10" style="overflow: hidden;">
        <div class="container mx-auto text-center">
            <p class="text-jkt-gold font-semibold">&copy; 2024 JKT48 Official Fansite</p>
            <a href="https://www.instagram.com/habib_prdtr" target="_blank"><i class="fab fa-instagram"></i> Author</a>
            <p class="mt-2 text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
        </div>
    </footer>
</body>
</html>
