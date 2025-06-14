<?php 
if (!isset($_SESSION['login'])) {
    header('Location: ../user/login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Member</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Script untuk preview foto baru
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block'; // Menampilkan gambar setelah dipilih
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex min-h-screen bg-gradient-to-r from-blue-100 to-purple-200">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto bg-white p-6 rounded-lg shadow-md max-w-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Member</h2>

                <!-- Form to update member -->
                <form action="index.php?modul=member&fitur=update" method="POST" enctype="multipart/form-data">
                    <!-- Hidden ID -->
                    <input type="hidden" name="id" value="<?= $memberData['id'] ?>">

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="nama" id="nama" value="<?= $memberData['nama'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?= $memberData['tanggalLahir'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Blood Type -->
                    <div class="mb-4">
                        <label for="golonganDarah" class="block text-sm font-medium text-gray-700">Blood Type</label>
                        <select name="golonganDarah" id="golonganDarah" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                            <option value="A" <?= $memberData['golonganDarah'] == 'A' ? 'selected' : '' ?>>A</option>
                            <option value="B" <?= $memberData['golonganDarah'] == 'B' ? 'selected' : '' ?>>B</option>
                            <option value="AB" <?= $memberData['golonganDarah'] == 'AB' ? 'selected' : '' ?>>AB</option>
                            <option value="O" <?= $memberData['golonganDarah'] == 'O' ? 'selected' : '' ?>>O</option>
                        </select>
                    </div>

                    <!-- Horoscope -->
                    <div class="mb-4">
                        <label for="horoskop" class="block text-sm font-medium text-gray-700">Horoscope</label>
                        <input type="text" name="horoskop" id="horoskop" value="<?= $memberData['Horoskop'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Height -->
                    <div class="mb-4">
                        <label for="tinggiBadan" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                        <input type="number" name="tinggiBadan" id="tinggiBadan" value="<?= $memberData['tinggiBadan'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Current Photo -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Current Photo</label>
                        <div class="mt-2">
                            <img src="../images/member/<?= $memberData['foto'] ?>" alt="Current Photo" class="w-32 h-32 rounded-lg border border-gray-300">
                        </div>
                    </div>

                    <!-- Upload New Photo -->
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Upload New Photo (Optional)</label>
                        <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full rounded-lg border border-gray-300" onchange="previewImage(event)">
                        <input type="hidden" name="old_foto" value="<?= $memberData['foto'] ?>">

                        <!-- Preview New Photo -->
                        <div class="mt-2">
                            <img id="preview" src="#" alt="Preview" class="w-32 h-32 rounded-lg border border-gray-300" style="display: none;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
