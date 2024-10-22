<?php
/*
$servername = "localhost";
$username = "id19714827_data_invoice";
$password = ")(\+bN>7qs_}yW25";
$dbname = "id19714827_invoice";
$conn = mysqli_connect($servername, $username, $password, $dbname);
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salumCompany";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
