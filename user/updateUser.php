<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
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
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>
<body class="bg-red-100">
<?php include 'navbar.php'; ?>
<div class="container mx-auto p-4 md:p-16">
    <div class="flex flex-col-reverse md:flex-row items-start space-y-6 md:space-y-0 md:space-x-6">
      <!-- Poster Gambar (disembunyikan pada mobile) -->
      <div class="flex-1 bg-gray-200 rounded-lg p-4 hidden md:block">
        <img src="../images/2.jpg" alt="Poster Edit User" class="rounded-lg shadow-md object-cover w-full h-full">
      </div>
      
      <!-- Formulir Edit -->
      <div class="flex-1 max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit User</h2>
        <form action="index.php?modul=user&fitur=update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

            <!-- Informasi Login -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">● Informasi Login</h3>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email*</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                </div>
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi* </label>
                    <input type="password" name="password" id="password" placeholder="(kosongkan jika tidak ingin mengubah kata sandi)" maxlength="12" class="mt-1 p-2 w-full rounded-lg border border-gray-300">
                </div>
            </div>

            <!-- Informasi User -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">● Informasi User</h3>
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap*</label>
                    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($user['nama']) ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                </div>
                <div>
                    <label for="oshimen" class="block text-sm font-medium">Anggota yang paling disukai (Oshimen)*</label>
                    <select id="oshimen" name="idMemberJkt" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="">Pilih Oshimen...</option>
                        <?php foreach ($members as $member): ?>
                            <option value="<?= htmlspecialchars($member['id']) ?>" <?= $user['idMemberJkt'] == $member['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($member['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin*</label>
                    <div class="mt-2 space-x-4">
                        <label>
                            <input type="radio" name="jenisKelamin" value="Pria" <?= isset($user['jenisKelamin']) && $user['jenisKelamin'] === "Pria" ? 'checked' : '' ?> required> Pria
                        </label>
                        <label>
                            <input type="radio" name="jenisKelamin" value="Wanita" <?= isset($user['jenisKelamin']) && $user['jenisKelamin'] === "Wanita" ? 'checked' : '' ?> required> Wanita
                        </label>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir*</label>
                    <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?= htmlspecialchars($user['tanggalLahir']) ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                </div>
                <div class="mt-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat*</label>
                    <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($user['alamat']) ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                </div>
                <div class="mt-4">
                    <label for="foto" class="block text-sm font-medium text-gray-700">Upload Foto*</label>
                    <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full rounded-lg border border-gray-300" onchange="previewImage(event)">
                    <!-- Menampilkan foto lama jika tidak ada file baru yang dipilih -->
                    <img id="imagePreview" src="../images/user/<?= htmlspecialchars($user['foto']) ?>" alt="Image Preview" class="mt-4 rounded-lg border border-gray-300" style="max-width: 100%; height: auto; <?= isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK ? 'display:none;' : '' ?>">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg w-full">
                    Simpan Perubahan
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>

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
