<?php
// Mengimpor model yang berisi method getMembers dan getMemberById
require_once '../models/memberJkt.php';

// Membuat objek dari kelas MemberModel
$memberModel = new MemberModel();

// Mengecek apakah ada ID anggota pada URL
if (isset($_GET['id'])) {
    // Mendapatkan ID anggota dari URL
    $id = $_GET['id'];

    // Mengambil data anggota berdasarkan ID
    $member = $memberModel->getDetailedMemberById($id);
} else {
    // Mengambil data anggota jika tidak ada ID (menampilkan daftar anggota)
    $members = $memberModel->getMembers();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota JKT48</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col">
<?php include 'navbar.php'; ?>

<?php if (isset($member)): ?>
    <!-- Halaman Detail Anggota -->
    <main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800 bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
        JKT48 Member Profile
    </h2>
    <div class="bg-white bg-opacity-80 backdrop-blur-lg rounded-2xl shadow-lg max-w-4xl mx-auto w-full sm:w-11/12 lg:max-w-4xl">

    <div class="w-full max-w-4xl bg-base-100 shadow-xl rounded-lg overflow-hidden">
        <div class="flex flex-row p-2 sm:p-4 space-x-2 sm:space-x-4">
            <!-- Foto Anggota -->
            <div class="w-1/3">
                <div class="relative w-full h-full">
                    <img src="../images/member/<?= $member['Foto']; ?>" 
                         alt="Member Name" 
                         class="w-full h-full object-cover rounded-lg shadow-md">
                    <div class="absolute bottom-1 left-1 bg-white bg-opacity-75 backdrop-blur-sm rounded-full px-2 py-1 text-xs sm:text-sm">
                        <h3 class="font-semibold text-gray-800"><?= $member['Nama']; ?></h3>
                    </div>
                </div>
            </div>
            <!-- Informasi Anggota -->
            <div class="w-2/3 flex flex-col justify-center">
                <div class="stats stats-vertical shadow bg-base-200 bg-opacity-50 text-[10px] sm:text-sm">
                <div class="stat py-1 sm:py-2">
                    <div class="stat-title text-[8px] sm:text-xs md:text-sm lg:text-base">Blood Type</div>
                    <div class="stat-value text-primary text-xs sm:text-lg md:text-xl lg:text-4xl"><?= $member['Golongan Darah']; ?></div>
                </div>

                <div class="stat py-1 sm:py-2">
                    <div class="stat-title text-[8px] sm:text-xs md:text-sm lg:text-base">Zodiac Sign</div>
                    <div class="stat-value text-secondary text-xs sm:text-lg md:text-xl lg:text-4xl"><?= $member['Horoskop']; ?></div>
                </div>

                <div class="stat py-1 sm:py-2">
                    <div class="stat-title text-[8px] sm:text-xs md:text-sm lg:text-base">Birthday</div>
                    <div class="stat-value text-xs sm:text-lg md:text-xl lg:text-4xl"><?= $member['Tanggal Lahir']; ?></div>
                </div>

                <div class="stat py-1 sm:py-2">
                    <div class="stat-title text-[8px] sm:text-xs md:text-sm lg:text-base">Height</div>
                    <div class="stat-value text-xs sm:text-lg md:text-xl lg:text-4xl"><?= $member['Tinggi Badan']; ?> cm</div>
                </div>

                </div>
            </div>
        </div>
    </div>
</main>


<?php else: ?>
    <!-- Halaman Daftar Anggota -->
    <!-- Halaman Daftar Anggota -->
<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800 bg-gray-100 border-2 border-gray-300 rounded-lg py-2 px-4">
            Anggota JKT48
        </h2>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-4 md:gap-6">
            <?php foreach ($members as $member): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <!-- Foto Anggota -->
                    <a href="?id=<?= $member['id']; ?>" class="block group">
                        <div class="relative w-full aspect-[4/5] overflow-hidden">
                            <img src="../images/member/<?= $member['foto']; ?>" alt="<?= $member['nama']; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </a>
                    <!-- Nama Anggota -->
                    <div class="p-4">
                        <a href="?id=<?= $member['id']; ?>" class="block text-[9px] xs:text-xs sm:text-sm font-bold text-center bg-red-200 hover:bg-red-400 text-gray-800 hover:text-white py-1 sm:py-2 px-1 sm:px-4 rounded-lg border-2 border-red-300 hover:border-red-500 transition-colors duration-300 ">
                            <?= $member['nama']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php endif; ?>

<footer class="bg-gray-900 text-white py-4 mt-10" style="overflow: hidden;">
        <div class="container mx-auto text-center px-4">
            <p class="text-jkt-gold font-semibold text-sm sm:text-base">&copy; 2024 JKT48 Official Fansite</p>
            <a href="https://www.instagram.com/habib_prdtr" target="_blank" class="text-sm sm:text-base">
                <i class="fab fa-instagram"></i> Author
            </a>
            <p class="mt-2 text-xs sm:text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
        </div>
    </footer>
    <div id="toast-container" class="fixed bottom-5 right-5 space-y-2 z-50"></div>
</body>
<script src="../includes/notifikasi.js"></script>
</html>

