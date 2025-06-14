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
    <title>Insert Event</title>
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
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Insert New Event</h2>

                <!-- Form to insert event -->
                <form action="index.php?modul=event&fitur=add" method="POST" enctype="multipart/form-data">
                    <!-- Event Name -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Date -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Event Date</label>
                        <input type="date" name="tanggal" id="tanggal" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Location -->
                    <div class="mb-4">
                        <label for="tempat" class="block text-sm font-medium text-gray-700">Event Location</label>
                        <input type="text" name="tempat" id="tempat" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Price -->
                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700">Event Price</label>
                        <input type="number" name="harga" id="harga" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Stock -->
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" name="stok" id="stok" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Type -->
                    <div class="mb-4">
                        <label for="tipeEvent" class="block text-sm font-medium text-gray-700">Event Type</label>
                        <select name="tipeEvent" id="tipeEvent" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                            <option value="General">General</option>
                            <option value="OFC">OFC</option>
                        </select>
                    </div>

                    <!-- Event Photo -->
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Upload Event Photo</label>
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
