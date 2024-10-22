<?php
/*
$servername = "localhost";
$username = "id19714827_data_invoices";
$password = "nJn3(0p=~}SJ61=?";
$dbname = "id19714827_invoices";
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
