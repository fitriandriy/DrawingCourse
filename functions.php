<!-- buat function agar kalau ada perubahan di query atau saat konek database, maka cukup ubah di sini, gak di satu per satu halaman -->

<?php 

// konek ke databse
$conn = mysqli_connect("localhost", "root", "", "sakila");
$host = "localhost";
$user = "202410102062";
$pass = "secret";
$database = "uas202410102062";

// $conn = mysqli_connect($host, $user, $pass, $database) or die("Koneksi tidak ada");

// $conn = mysqli_connect("localhost", "202410102062", "secret", "uas202410102062");

// ambil data dari database
function query($query) {
    global $conn;
    // gantinya kode ini:
    // $result = mysqli_query($conn, "SELECT * FROM rental WHERE rental_id in (1,2,3,4,5)");
    $result = mysqli_query($conn, $query);

    $rows = [];
    // untuk tiap row data ditambahkan ke var rows
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    };

    // return rows dalam bentuk array assoc
    return $rows; 
};



// fungsi tambah
function tambah($data) {
    global $conn;

    // ambil data dari dalam form
    $Name           = htmlspecialchars($data["Name"]);
    $CountryCode    = htmlspecialchars($data["CountryCode"]);
    $District       = htmlspecialchars($data["District"]);
    $Info           = htmlspecialchars($data["Info"]);

    // insert into table 
    $query = "INSERT INTO 'city' ('Name', 'CountryCode', 'District', 'Info') VALUES ('$Name','$CountryCode','$District','$Info')
              ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};



function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM city WHERE ID = $id");
    return mysqli_affected_rows($conn);
};



function ubah($data) {
    global $conn;

    // ambil data dari dalam form
    $ID             = $data["ID"];
    $Name           = htmlspecialchars($data["Name"]);
    $CountryCode    = htmlspecialchars($data["CountryCode"]);
    $District       = htmlspecialchars($data["District"]);
    $Info           = htmlspecialchars($data["Info"]);
    // insert into table 
    $query = "UPDATE city SET
              Name   = '$Name', 
              CountryCode  = '$CountryCode', 
              District   = '$District', 
              Info   = '$Info'
              WHERE ID = $ID
              ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};



function cari($keyword) {
    $query = "SELECT * FROM city
              WHERE
              Name LIKE '%$keyword%' OR
              CountryCode LIKE '%$keyword%' OR
              District LIKE '%$keyword%' OR
              Info LIKE '%$keyword%' OR
              ID LIKE '%$keyword%'
             ";

    return query($query);
};



function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm = mysqli_real_escape_string($conn, $data["confirm"]);

    // cek akun sudah ada atau belum
    $check = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if( mysqli_fetch_assoc($check) ) {
        echo "<script>
                alert('username sudah terdaftar!');
              </script>";
        return false;
    };

    // confirm password
    if ( $password !== $confirm ) {
        echo "
            <script>
                alert('konfirmasi password tidak sesuai');
            </script>;
        ";
        return false;
    };

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // masukan password ke database
    mysqli_query($conn, "INSERT INTO users(username, password) 
                         VALUES ('$username', '$password')");

    return mysqli_affected_rows($conn);
};

?>