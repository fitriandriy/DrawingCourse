<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
};

require 'functions.php';

$rental_id = $_POST['rental_id'];

if( hapus($rental_id) > 0 ) {
    echo "
    <script>
        alert('Data berhasil dihapus!');
        document.location.href = 'index.php';
    </script>
    ";
} else {
echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href = 'index.php';
    </script>
    ";
};

?>