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
    <title>Update Event</title>
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
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Event</h2>

                <!-- Form to update event -->
                <form action="index.php?modul=event&fitur=update" method="POST" enctype="multipart/form-data">
                    <!-- Hidden ID -->
                    <input type="hidden" name="id" value="<?= $eventData['id'] ?>">

                    <!-- Event Name -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input type="text" name="nama" id="nama" value="<?= $eventData['nama'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Date -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Event Date</label>
                        <input type="date" name="tanggal" id="tanggal" value="<?= $eventData['tanggal'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Venue -->
                    <div class="mb-4">
                        <label for="tempat" class="block text-sm font-medium text-gray-700">Event Venue</label>
                        <input type="text" name="tempat" id="tempat" value="<?= $eventData['tempat'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Price -->
                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700">Event Price</label>
                        <input type="number" name="harga" id="harga" value="<?= $eventData['harga'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Stock -->
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" name="stok" id="stok" value="<?= $eventData['stok'] ?>" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                    </div>

                    <!-- Event Type -->
                    <div class="mb-4">
                        <label for="tipeEvent" class="block text-sm font-medium text-gray-700">Event Type</label>
                        <select name="tipeEvent" id="tipeEvent" class="mt-1 p-2 w-full rounded-lg border border-gray-300" required>
                            <option value="General" <?= $eventData['tipeEvent'] == 'General' ? 'selected' : '' ?>>General</option>
                            <option value="OFC" <?= $eventData['tipeEvent'] == 'OFC' ? 'selected' : '' ?>>OFC</option>
                        </select>
                    </div>

                    <!-- Current Event Photo -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Current Event Photo</label>
                        <div class="mt-2">
                            <img src="../images/event/<?= $eventData['foto'] ?>" alt="Current Event Photo" class="w-32 h-32 rounded-lg border border-gray-300">
                        </div>
                    </div>

                    <!-- Upload New Event Photo -->
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Upload New Event Photo (Optional)</label>
                        <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full rounded-lg border border-gray-300" onchange="previewImage(event)">
                        <input type="hidden" name="old_foto" value="<?= $eventData['foto'] ?>">

                        <!-- Preview Image -->
                        <div class="mt-2">
                            <img id="preview" src="#" alt="Preview" class="w-32 h-32 rounded-lg border border-gray-300" style="display: none;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
