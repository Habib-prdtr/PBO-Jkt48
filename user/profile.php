<?php
session_start();

require_once '../config/database.php'; 
require_once '../models/UserModel.php'; 

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    // Jika tidak, redirect ke halaman login
    header('Location: ../user/login.php');
    exit;
}

// Ambil ID pengguna dari session
$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$userModel = new UserModel();
$user = $userModel->getUserById($user_id);
$history = $userModel->getAllHistory($user_id);

// echo "<pre>";
// print_r($history);
// echo "</pre>";
// exit;

if (!$user) {
    // Jika data tidak ditemukan, tampilkan pesan error
    echo "Data pengguna tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Page</title>
  <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
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
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .content {
      flex: 1 0 auto;
    }
    footer {
      flex-shrink: 0;
    }
  </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
<?php include 'navbar.php'; ?>
<div class="content flex-grow">
    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
      <div class="bg-red-500 text-white text-center py-3 text-lg sm:text-2xl font-bold w-full">
        MY PAGE
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mt-6">
        <!-- Foto Member -->
        <div class="lg:col-span-1 flex justify-center">
          <div class="bg-gray-100 p-4 rounded-lg shadow">
            <img src="../images/member/<?php echo $user['fotoOshimen']; ?>" 
                 alt="<?php echo $user['fotoOshimen']; ?>" 
                 class="rounded-lg object-contain max-w-full h-auto">
          </div>
        </div>

        <!-- Data Pengguna -->
        <div class="lg:col-span-3">
          <div class="space-y-4">
            <div class="flex flex-wrap items-center border-b border-gray-300 pb-2">
              <div class="w-full sm:w-1/3 font-bold">Nomor Anggota:</div>
              <div class="w-full sm:w-2/3 text-sm">
                <?php echo $user['id']; ?> | 
                <a href="../user/cards.php?id=<?php echo $user['id']; ?>" class="text-red-500 hover:underline">
                  Lihat Kartu Anggota
                </a>
              </div>
            </div>
            <div class="flex flex-wrap items-center border-b border-gray-300 pb-2">
              <div class="w-full sm:w-1/3 font-bold">Nama:</div>
              <div class="w-full sm:w-2/3 text-sm"><?php echo $user['nama']; ?></div>
            </div>
            <div class="flex flex-wrap items-center border-b border-gray-300 pb-2">
              <div class="w-full sm:w-1/3 font-bold">Jenis Keanggotaan:</div>
              <div class="w-full sm:w-2/3 text-sm"><?php echo $user['tipeUser']; ?></div>
            </div>
            <div class="flex flex-wrap items-center border-b border-gray-300 pb-2">
              <div class="w-full sm:w-1/3 font-bold">Oshimen:</div>
              <div class="w-full sm:w-2/3 text-sm">
                <a href="member.php?id=<?php echo $user['idMemberJkt']; ?>" class="text-red-500 hover:underline">
                  <?php echo $user['namaOshimen']; ?>
                </a>
              </div>
            </div>
            <div class="flex flex-wrap items-center border-b border-gray-300 pb-2">
              <div class="w-full sm:w-1/3 font-bold">Jumlah JKT48 Points:</div>
              <div class="w-full sm:w-2/3">
                <div class="flex flex-wrap items-center justify-between text-sm">
                  <span>Saldo Poin: <?php echo $user['saldo']; ?> P</span>
                  </div>
                  <a href="../admin/index.php?modul=topUp&fitur=input" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 inline-flex max-w-max">Beli JKT48 Points</a>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-300 pt-6 mt-6 ml-4">
        <h3 class="text-lg sm:text-xl font-semibold mb-4 border-b-2 border-gray-300 pb-2">Menu Anggota</h3>
        <ul class="space-y-2 text-sm">
          <li>
            <a href="index.php?modul=user&fitur=edit&id=<?php echo $user['id']; ?>" class="text-red-500 hover:underline">Ubah Data Pribadi</a>
          </li>
          <li>
            <a href="index.php?modul=user&fitur=delete&id=<?php echo $user['id']; ?>" class="text-red-500 hover:underline">Keluar dari Keanggotaan</a>
          </li>
        </ul>
      </div>

      <div class="border-t border-gray-300 pt-6 mt-6 ml-4 mb-8">
        <h3 class="text-lg sm:text-xl font-semibold mb-4 border-b-2 border-gray-300 pb-2">History JKT48 Points</h3>
        <div class="overflow-x-auto p-4 bg-gray-50 rounded-lg shadow-md">
          <table class="table-auto w-full border border-gray-200 text-sm">
            <thead class="bg-gradient-to-r from-red-500 to-red-400 text-white">
              <tr>
                <th class="px-4 sm:px-6 py-3 text-center font-semibold">Type</th>
                <th class="px-4 sm:px-6 py-3 text-center font-semibold">ID</th>
                <th class="px-4 sm:px-6 py-3 text-center font-semibold">Tanggal</th>
                <th class="px-4 sm:px-6 py-3 text-center font-semibold">Jumlah</th>
                <th class="px-4 sm:px-6 py-3 text-center font-semibold">Perubahan Poin</th>
                <th class="px-4 sm:px-6 py-3 text-center font-semibold">Operasi</th>
              </tr>
            </thead>
            <tbody>
            <?php if (!empty($history)) : ?>
                <?php foreach ($history as $index => $item) : 
                    $jumlah = ($item['type'] === 'topUp') ? "{$item['jumlah']}" : "{$item['jumlah']}";
                    $id = $item['id'] + 919;
                    $perubahanPoin = ($item['type'] === 'topUp' && $item['status'] === 'rejected') 
                ? "+0" 
                : (($item['type'] === 'topUp') 
                    ? "+{$jumlah}" 
                    : "-{$jumlah}");
                ?>
                    <tr class="hover:bg-gray-100 transition duration-150">
                        <td class="border px-6 py-4 text-center font-medium text-gray-800"><?= ucfirst($item['type']) ?></td>
                        <td class="border px-6 py-4 text-center font-medium text-gray-800"><?= $id ?></td>
                        <td class="border px-6 py-4 text-center font-medium text-gray-600"><?= $item['Tanggal'] ?></td>
                        <td class="border px-6 py-4 text-center font-medium text-green-600"><?= $jumlah ?> P</td>
                        <td class="border px-6 py-4 text-center font-medium <?= ($item['type'] === 'topUp') ? 'text-blue-600' : 'text-red-600' ?>">
                            <?= $perubahanPoin ?> P
                        </td>
                        <td class="border px-6 py-4 text-center font-medium">
                            <button 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                                onclick="showDetailModal(<?= $index ?>)">Detail</button>
                        </td>
                    </tr>
                    <div id="modal-<?= $index ?>" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-xl p-4 w-full max-w-md shadow-lg relative">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 flex items-center">
                            <span class="inline-block bg-red-500 text-white w-6 h-6 flex items-center justify-center rounded-full mr-2 text-sm">
                                <?= ucfirst($item['type'])[0] ?>
                            </span>
                            Detail <?= ucfirst($item['type']) ?>
                        </h2>
                        <div class="space-y-2 border-t pt-2">
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-gray-600 font-medium font-bold text-left">ID</span>
                                <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                <span class="text-gray-800 font-medium text-sm text-left"><?= $item['id'] ?></span>
                            </div>
                              
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-gray-600 font-medium font-bold text-left">Tanggal</span>
                                <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                <span class="text-gray-800 text-sm text-left"><?= $item['Tanggal'] ?></span>
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-gray-600 font-medium font-bold text-left">Jumlah</span>
                                <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                <span class="text-green-600 font-medium text-sm text-left"><?= $item['jumlah'] ?> P</span>
                            </div>
                            <?php if ($item['type'] === 'topUp') : ?>
                                <div class="grid grid-cols-3 gap-1">
                                    <span class="text-gray-600 font-medium font-bold text-left">Status</span>
                                    <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                    <span class="text-blue-600 font-medium text-sm text-left"><?= $item['status'] ?? 'N/A' ?></span>
                                </div>
                            <?php elseif ($item['type'] === 'transaksi') : ?>
                                <div class="grid grid-cols-3 gap-1">
                                    <span class="text-gray-600 font-medium font-bold text-left">Nama Event</span>
                                    <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                    <span class="text-gray-800 text-sm text-left"><?= $item['eventNama'] ?? 'Upgrade OFC' ?></span>
                                </div>
                                <div class="grid grid-cols-3 gap-1">
                                    <span class="text-gray-600 font-medium font-bold text-left">Jumlah Tiket</span>
                                    <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                    <span class="text-gray-800 text-sm text-left"><?= $item['jumlahTiket'] ?? 'N/A' ?></span>
                                </div>
                                <div class="grid grid-cols-3 gap-1">
                                    <span class="text-gray-600 font-medium font-bold text-left">Bayar</span>
                                    <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                    <span class="text-gray-800 text-sm text-left"><?= $item['bayar'] ?? 'N/A' ?></span>
                                </div>
                                <div class="grid grid-cols-3 gap-1">
                                    <span class="text-gray-600 font-medium font-bold text-left">Kembalian</span>
                                    <span class="text-gray-600 font-medium text-sm text-left">:</span>
                                    <span class="text-gray-800 text-sm text-left"><?= $item['kembalian'] ?? 'N/A' ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-4 text-right">
                        <a href="../user/cetak.php?id=<?= $item['id'] ?>" target="_blank">
                                <button class="inline-flex items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 shadow-lg transition text-sm">
                                    <span class="material-icons-outlined mr-2">print</span>
                                    Cetak PDF
                                </button>
                            </a>
                        </div>
                        <div class="mt-4 text-right">
                            <button 
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm"
                                onclick="hideDetailModal(<?= $index ?>)">
                                Tutup
                            </button>
                        </div>
                        <button 
                            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition text-lg"
                            onclick="hideDetailModal(<?= $index ?>)">
                            &times;
                        </button>
                    </div>
                </div>

                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td class="border px-6 py-4 text-center font-medium text-gray-500 italic" colspan="6">Tidak ada sejarah poin.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function showDetailModal(index) {
    document.getElementById(`modal-${index}`).classList.remove('hidden');
}

function hideDetailModal(index) {
    document.getElementById(`modal-${index}`).classList.add('hidden');
}
</script>
    </div>
  </div>
  <footer class="bg-gray-900 text-white py-4 w-full" style="overflow: hidden;">
    <div class="container mx-auto text-center px-4">
      <p class="text-jkt-gold font-semibold text-sm sm:text-base">&copy; 2024 JKT48 Official Fansite</p>
      <a href="https://www.instagram.com/habib_prdtr" target="_blank" class="text-sm sm:text-base">
        <i class="fab fa-instagram"></i> Author
      </a>
      <p class="mt-2 text-xs sm:text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
    </div>
  </footer>
</body>
</html>