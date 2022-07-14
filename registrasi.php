<?php 

require 'functions.php';

if ( isset($_POST["register"]) ) {
    if ( registrasi($_POST) > 0 ) {
        echo "
            <script>
                alert('berhasil registrasi');
            </script>
        ";
        header("Location: login.php");
    
    } else {
        echo mysqli_error($conn);
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Halaman Registrasi</h1>

<form action="" method="post">

    <ul>
        <li>
            <label for="username">username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="confirm">konfirmasi password :</label>
            <input type="password" name="confirm" id="confirm">
        </li>
        <li>
            <button type="submit" name="register">Register</button>
        </li>
    </ul>

</form>

</body>
</html>