<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
};

require 'functions.php';

// ambil data rental_id dari form di index
$rental_id = $_POST["rental_id"];

// query data berdasarkan id
$data = query("SELECT * FROM city WHERE ID = $rental_id")[0];

// cek apakah submit sudah ditekan
if ( isset($_POST["update"]) ) {
    
    if ( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
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
    <title>Ubah Data Rental Film</title>
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
</head>
<body>

    <h1>Ubah Data Rental Film</h1>
    
    <form action="" method="post">

        <input type="hidden" name="ID" value="<?= $data['rental_id']; ?>">
        <ul>
            <li>
                <label for="rental_date">Name:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="Name" id="rental_date" required value=" <?php echo $data['Name']; ?>">
            </li>
            <li>
                <label for="inventory_id">CountryCode:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="CountryCode" id="inventory_id" required value=" <?php echo $data['CountryCode']; ?>">
            </li>
            <li>
                <label for="customer_id">District:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="District" id="customer_id" required value=" <?php echo $data['District']; ?>">
            </li>
            <li>
                <label for="return_date">Info:</label>
                <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" type="text" name="Info" id="return_date" required value=" <?php echo $data['Info']; ?>">
            </li>
            <li>
                <button name="update">Ubah Data</button>
            </li>
        </ul>

    </form>

</body>
</html>