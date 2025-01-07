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
    $member = $memberModel->getMemberById($id);
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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
<?php include 'navbar.php'; ?>

<?php if (isset($member)): ?>
    <!-- Halaman Detail Anggota -->
    <main class="flex-grow py-8">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-semibold mb-6 text-center">Anggota JKT48</h2>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex max-w-4xl mx-auto">
                <!-- Foto Anggota di Kiri -->
                <div class="w-1/3 p-4">
                    <div class="relative w-full h-400"> <!-- Menyesuaikan tinggi gambar -->
                        <img src="../images/member/<?= $member['foto']; ?>" alt="<?= $member['nama']; ?>" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                </div>
                <!-- Informasi Anggota di Kanan -->
                <div class="w-2/3 p-6 flex flex-col justify-center">
                    <h3 class="text-2xl font-semibold"><?= $member['nama']; ?></h3>
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <p><strong>Golongan Darah:</strong> <?= $member['golonganDarah']; ?></p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <p><strong>Horoskop:</strong> <?= $member['Horoskop']; ?></p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <p><strong>Tanggal Lahir:</strong> <?= $member['tanggalLahir']; ?></p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <p><strong>Tinggi Badan:</strong> <?= $member['tinggiBadan']; ?> cm</p>
                        </div>
                    </div>
                    <!-- <div class="mt-6">
                        <a href="member.php" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </main>
<?php else: ?>
    <!-- Halaman Daftar Anggota -->
    <main class="flex-grow py-8">
    <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800 bg-gray-100 border-2 border-gray-300 rounded-lg py-2 px-4">
 Anggota JKT48
</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php foreach ($members as $member): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <!-- Foto Anggota -->
                    <a href="?id=<?= $member['id']; ?>" class="block group">
                        <div class="relative w-full h-80 overflow-hidden">
                            <img src="../images/member/<?= $member['foto']; ?>" alt="<?= $member['nama']; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </a>
                    <!-- Nama Anggota dengan Kotak Merah Pudar -->
                    <div class="p-4">
                        <a href="?id=<?= $member['id']; ?>" class="block text-lg font-bold text-center bg-red-200 hover:bg-red-400 text-gray-800 hover:text-white py-2 px-4 rounded-lg border-2 border-red-300 hover:border-red-500 transition-colors duration-300">
                            <?= $member['nama']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>


<?php endif; ?>


<footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 JKT48 Fansite. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
