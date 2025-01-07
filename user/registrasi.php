<?php 
if (isset($_SESSION['login'])) {
    echo "<script>alert('Saat ini Anda sudah Login.');</script>";
    echo "<script>window.location.href='profile.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block'; // Show the image
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>
<body class="bg-red-100">
<?php include 'navbar.php'; ?>
  <div class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row items-start space-y-6 md:space-y-0 md:space-x-6">
      <!-- Poster Gambar -->
      <div class="flex-1 bg-gray-200 rounded-lg p-4">
        <img src="../images/login.webp" alt="Poster Registrasi" class="rounded-lg shadow-md object-cover w-full h-full">
      </div>
      <!-- Formulir Registrasi -->
      <div class="flex-1 max-w-md bg-white p-8 rounded-lg shadow-md">
            
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Input User Baru</h2>
                <?php if (isset($error_message)): ?>
             <div class="bg-red-500 text-white p-2 mb-4 rounded">
                 <?= htmlspecialchars($error_message); ?>
             </div>
         <?php endif; ?>
                <form action="index.php?modul=user&fitur=add" method="POST" enctype="multipart/form-data">
                    <!-- Informasi Login -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">● Informasi Login</h3>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email*</label>
                            <input type="email" name="email" id="email" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                        </div>
                        <div class="mt-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi*</label>
                            <input type="password" name="password" id="password" maxlength="12" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                        </div>
                    </div>

                    <!-- Informasi User -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">● Informasi User</h3>
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap*</label>
                            <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                        </div>
                        <div>
                            <label for="oshimen" class="block text-sm font-medium">Anggota yang paling disukai (Oshimen)*</label>
                            <select id="oshimen" name="idMemberJkt" class="w-full p-2 border border-gray-300 rounded-lg" required>
                                <option value="">Pilih Oshimen...</option>
                                <?php foreach ($members as $member): ?>
                                    <option value="<?= htmlspecialchars($member['id']) ?>">
                                        <?= htmlspecialchars($member['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin*</label>
                            <div class="mt-2 space-x-4">
                                <label><input type="radio" name="gender" value="1" required> Pria</label>
                                <label><input type="radio" name="gender" value="2" required> Wanita</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir*</label>
                            <input type="date" name="tanggalLahir" id="tanggalLahir" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                        </div>
                        <div class="mt-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat*</label>
                            <input type="text" name="alamat" id="alamat" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                        </div>
                        <div class="mt-4">
                            <label for="foto" class="block text-sm font-medium text-gray-700">Upload Foto*</label>
                            <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required onchange="previewImage(event)">
                            <img id="imagePreview" src="" alt="Image Preview" class="mt-4 rounded-lg border border-gray-300" style="display:none; max-width: 100%; height: auto;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg w-full">
                            Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
