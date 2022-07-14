<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: registrasi.php");
    exit;
};

// untuk menghubungkan dengan functions.php
require 'functions.php';

// pagination
// menentukan ada berapa data di satu halaman
$jumlahDataPerHalaman   = 200;
$jumlahData             = count(query("SELECT * FROM city"));
$jumlahHalaman          = ceil($jumlahData/$jumlahDataPerHalaman);
$whereAmI               = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

$awalData               = ($jumlahDataPerHalaman * $whereAmI) - $jumlahDataPerHalaman;
$rental = query("SELECT * FROM city LIMIT $awalData, $jumlahDataPerHalaman");

// kalau tombol cari ditekan
if (isset($_POST["cari"])) {
    $rental = cari($_POST["keyword"]);
};
?> 




<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap');
        body {
            font: 16px/24px 'Quicksand', sans-serif;
            padding: 0px 140px;
        }
        
        a {
            text-decoration: none;
            color: darkblue;
        }

        a:hover {
            font-weight: bold;
        }

        form {
            padding-bottom: 5px;
        }
    </style>
    <title>Halaman Admin</title>
</head>

<body>

<h1>Tabel City</h1>

<div class="content">
    <a href="logout.php">Logout | </a>

    <!-- aksi menambahkan data -->
    <a href="create.php">Tambahkan Data</a>

    <!-- aksi mencari data -->
    <form action="" method="post">
        <input type="text" name="keyword" placeholder="masukan keyword pencarian" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombolCari">Cari</button>
    </form>

    <!-- aksi menghapus data -->
    <form action="delete.php" method="post">
        <label for="rental_id">Hapus data : </label>
        <input type="text" name="rental_id" id="rental_id" placeholder="id yang ingin dihapus" required>
        <button name="submit" onclick="return confirm('Apakah anda yakin untuk menghapus data pada baris tersebut?');"> Hapus </button>
    </form>

    <!-- aksi mengubah data -->
    <form action="update.php" method="post">
        <label for="rental_id">Rubah data  : </label>
        <input type="text" name="rental_id" id="rental_id" placeholder="id yang ingin diubah" required>
        <button name="submit"> Ubah </button>
    </form>
    <br>
</div>

<!-- navigasi -->
<nav aria-label="Page navigation example">
    <?php if($whereAmI > 1) : ?>
        <a href="?halaman=<?= $whereAmI -1; ?>"> &laquo; </a>
        <?php endif; ?>
        
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $whereAmI ) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold;"> <?php echo $i ?> </a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"> <?php echo $i ?> </a>
        <?php endif; ?>
    <?php endfor; ?>
    
    <?php if($whereAmI < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $whereAmI + 1; ?>"> &raquo; </a>
        <?php endif; ?>
</nav>

<div id="container">
    <table border="1" cellpadding="10" cellspacing="0" class="table table-striped table-hover">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>CountryCode</th>
            <th>District</th>
            <th>Info</th>
        </tr>

        <!-- yang tadinya pakai while, karena bentuk data yg ditampilkan adalah array assoc, maka diubah jadi foreach -->
        <?php foreach( $rental as $row ) : ?>
        <tr>
            <td><?php echo $row["ID"]; ?></td>
            <td><?php echo $row["Name"]; ?></td>
            <td><?php echo $row["CountryCode"]; ?></td>
            <td><?php echo $row["District"]; ?></td>
            <td><?php echo $row["Info"]; ?></td>           
        </tr>
        <?php endforeach; ?>            

    </table>
</div>


<script src="js/script.js"></script>
</body>
</html>