<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Member</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
                <!-- Button to Insert New Member -->
                <div class="mb-4">
                    <a href="index.php?modul=member&fitur=input" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                        Insert New Member
                    </a>
                </div>

                <!-- Members Table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Member ID</th>
                                <th scope="col" class="px-6 py-3">Foto</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Blood Type</th>
                                <th scope="col" class="px-6 py-3">Horoscope</th>
                                <th scope="col" class="px-6 py-3">Height</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            // Loop through each member
                            foreach ($members as $member) {
                            ?>
                                <tr class="bg-white border-b hover:bg-indigo-50">
                                    <!-- Member ID -->
                                    <td class="px-6 py-4"><?php echo $index++; ?></td>
                                  
                                    <!-- Foto -->
                                    <td class="px-6 py-4">
                                        <img src="../images/member/<?php echo htmlspecialchars($member['foto']); ?>" alt="Foto Member" class="w-16 h-16 rounded-full object-cover">
                                    </td>
                                  
                                    <!-- Name -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($member['nama']); ?></td>

                                    <!-- Blood Type -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($member['golonganDarah']); ?></td>
                                  
                                    <!-- Horoscope -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($member['Horoskop']); ?></td>
                                  
                                    <!-- Height -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($member['tinggiBadan']); ?> cm</td>

                                    <!-- Action -->
                                    <td class="px-6 py-4 text-center">
                                        <a href="index.php?modul=member&fitur=edit&id=<?php echo $member['id']; ?>" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-2 rounded-lg mr-2 transition duration-200">Update</a>
                                        <a href="index.php?modul=member&fitur=delete&id=<?php echo $member['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded-lg mr-2 transition duration-200">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
