<?php 
session_start();

require_once '../config/database.php'; // Ganti dengan path yang sesuai
require_once '../models/UserModel.php'; // Ganti dengan path yang sesuai

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Card Design</title>
  <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Abel');

html, body {
  background: #FCEEB5;
  font-family: Abel, Arial, Verdana, sans-serif;
}

.center {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
}

.card {
  width: 450px;
  height: 250px;
  background-color: #fff;
  background: linear-gradient(#f8f8f8, #fff);
  box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
  border-radius: 6px;
  overflow: hidden;
  position: relative;
  margin: 1.5rem;
}

.card h1 {
  text-align: center;
}

.card .additional {
  position: absolute;
  width: 150px;
  height: 100%;
  background: linear-gradient(#dE685E, #EE786E);
  transition: width 0.4s;
  overflow: hidden;
  z-index: 2;
}

.card.green .additional {
  background: linear-gradient(#92bCa6, #A2CCB6);
}


.card:hover .additional {
  width: 100%;
  border-radius: 0 5px 5px 0;
}

.card .additional .user-card {
  width: 150px;
  height: 100%;
  position: relative;
  float: left;
}

.card .additional .user-card::after {
  content: "";
  display: block;
  position: absolute;
  top: 10%;
  right: -2px;
  height: 80%;
  border-left: 2px solid rgba(0,0,0,0.025);
}

.card .additional .user-card .level{
  top: 15%;
  color: #fff;
  text-transform: uppercase;
  font-size: 1.25em;
  font-weight: bold;
  background: rgba(0,0,0,0.15);
  padding: 0.125rem 0.75rem;
  border-radius: 100px;
  white-space: nowrap;
}
.card .additional .user-card .points {
  top: 15%;
  color: #fff;
  text-transform: uppercase;
  font-size: 0.75em;
  font-weight: bold;
  background: rgba(0,0,0,0.15);
  padding: 0.125rem 0.75rem;
  border-radius: 100px;
  white-space: nowrap;
}

.card .additional .user-card .points {
  top: 85%;
}

.card .additional .user-card svg {
  top: 50%;
}

.card .additional .more-info {
  width: 300px;
  float: left;
  position: absolute;
  left: 150px;
  height: 100%;
}

.card .additional .more-info h1 {
  color: #fff;
  margin-bottom: 15px;
}

.card.green .additional .more-info h1 {
  color: #224C36;
}

.card .additional .coords {
  margin-top: 7px;
  margin-right: 20px;
  margin-left: 20px;
  color: #fff;
  font-size: 1rem;
}

.card.green .additional .coords {
  color: #325C46;
}

.card .additional .coords span + span {
  float: right;
  
}

.card .additional .stats {
  font-size: 2rem;
  display: flex;
  position: absolute;
  bottom: 1rem;
  left: 1rem;
  right: 1rem;
  top: auto;
  color: #fff;
}

.card.green .additional .stats {
  color: #325C46;
}

.card .additional .stats > div {
  flex: 1;
  text-align: center;
}

.card .additional .stats i {
  display: block;
}

.card .additional .stats div.title {
  font-size: 0.75rem;
  font-weight: bold;
  text-transform: uppercase;
}

.card .additional .stats div.value {
  font-size: 1.5rem;
  font-weight: bold;
  line-height: 1.5rem;
}

.card .additional .stats div.value.infinity {
  font-size: 2.5rem;
}

.card .general {
  width: 300px;
  height: 100%;
  position: absolute;
  top: 0;
  right: 0;
  z-index: 1;
  box-sizing: border-box;
  padding: 1rem;
  padding-top: 0;
}

.card .general .more {
  position: absolute;
  bottom: 1rem;
  right: 1rem;
  font-size: 0.9em;
}

.logo-small {
    width: 200px; /* Sesuaikan ukuran logo kecil */
    height: 100px;
    margin-top: 5px; /* Sesuaikan jarak logo */
    margin-left: 35px;
    
}

.coords span strong{
    font-weight: bold;
}
    </style>
    </head>
    <body>
    <div class="center">
        <div class="card">
            <div class="additional">
                <div class="user-card">
                    <div class="level center">
                    <?php echo ucfirst($user['tipeUser']); ?>
                    </div>
                    <div class="points center">
                    <?php echo ucfirst($user['saldo']); ?> P
                    </div>
                    <svg width="110" height="110" viewBox="0 0 250 250" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="title desc" class="center">
                        <title id="title">User Photo</title>
                        <desc id="desc">Foto Profil Pengguna</desc>
                        <circle cx="125" cy="125" r="120" fill="rgba(0,0,0,0.15)" />
                        <g stroke="none" stroke-width="0" clip-path="url(#scene)">
                            <circle cx="125" cy="125" r="100" fill="#eab38f" />
                            <clipPath id="clipCircle">
                                <circle cx="125" cy="125" r="100" />
                            </clipPath>
                            <image href="../images/user/<?php echo $user['foto']; ?>" x="25" y="25" width="200" height="200" clip-path="url(#clipCircle)" />
                        </g>
                    </svg>

                </div>
                <div class="more-info">
                    <h1><?php echo ucfirst($user['nama']); ?></h1>
                    <div class="coords">
                        <span><strong>Email:</strong></span>
                        <span><?php echo $user['email']; ?></span>
                    </div>
                    <div class="coords">
                        <span><Strong>Oshimen:</Strong></span>
                        <span><?php echo $user['namaOshimen']; ?></span>
                    </div>
                    <div class="coords">
                        <span><Strong>Jenis Kelamin:</Strong></span>
                        <span><?php echo ucfirst($user['jenisKelamin']); ?></span>
                    </div>
                    <div class="coords">
                        <span><Strong>Tanggal Lahir:</Strong></span>
                        <span><?php echo $user['tanggalLahir']; ?></span>
                    </div>
                    <div class="coords">
                        <span><Strong>Alamat:</Strong></span>
                        <span><?php echo $user['alamat']; ?></span>
                    </div>
                </div>
            </div>
            <div class="general">
                <h1>Profil Pengguna</h1>
                <img src="../images/3.png" alt="Logo Kecil" class="logo-small">
                <span class="more">Mouse over the card for more info</span>
            </div>
        </div>
    </div>
</body>

  </html>
  