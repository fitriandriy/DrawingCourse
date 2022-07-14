<?php 
require "../functions.php";

$keyword = $_GET["keyword"];

$query = "SELECT * FROM city
        WHERE
        Name LIKE '%$keyword%' OR
        CountryCode LIKE '%$keyword%' OR
        District LIKE '%$keyword%' OR
        Info LIKE '%$keyword%' OR
        ID LIKE '%$keyword%'
        ";

$rental = query($query);
?>

<table border="1" cellpadding="10" cellspacing="0">

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