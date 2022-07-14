<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
};

require 'functions.php';

// cek apakah submit sudah ditekan
if ( isset($_POST["submit"]) ) {
    
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Data Rental Film</title>
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

        li {
            padding-bottom: 5px;
        }
    </style>
</head>
<body>

    <h1>Tambah Data Rental Film</h1>
    
    <form action="" method="post">
        <div class="input-group mb-3">
        <ul>
            <li>
                <label for="rental_date">Name:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="Name" id="rental_date" required>
            </li>
            <li>
                <label for="inventory_id">CountryCode:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="CountryCode" id="inventory_id" required>
            </li>
            <li>
                <label for="customer_id">District:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="District" id="customer_id" required>
            </li>
            <li>
                <label for="return_date">Info:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="Info" id="return_date" required>
            </li>
            <li>
                <button name="submit">Tambah Data</button>
            </li>
        </ul>
        </div>

    </form>

</body>
</html>