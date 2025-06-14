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
    <title>Insert Member</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block'; // Show the image
            }

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
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Insert New Member</h2>

                <!-- Form to insert member -->
                <form action="index.php?modul=member&fitur=add" method="POST" enctype="multipart/form-data">
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="tanggalLahir" id="tanggalLahir" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Blood Type -->
                    <div class="mb-4">
                        <label for="golonganDarah" class="block text-sm font-medium text-gray-700">Blood Type</label>
                        <select name="golonganDarah" id="golonganDarah" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>

                    <!-- Horoscope -->
                    <div class="mb-4">
                        <label for="horoskop" class="block text-sm font-medium text-gray-700">Horoscope</label>
                        <input type="text" name="horoskop" id="horoskop" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Height -->
                    <div class="mb-4">
                        <label for="tinggiBadan" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                        <input type="number" name="tinggiBadan" id="tinggiBadan" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Photo -->
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Upload Photo</label>
                        <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full rounded-lg border border-gray-300" onchange="previewImage(event)" required>
                    </div>

                    <!-- Image Preview -->
                    <div class="mb-4">
                        <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 100%; height: auto; border-radius: 8px;">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
