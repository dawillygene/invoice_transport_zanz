<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Execute a MySQL SELECT query to fetch data from a table
$sql = "SELECT id, Name, Email FROM mydatabase";
$result = mysqli_query($conn, $sql);

// Fetch the data and store it in an array
$rows = array();
while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

// Generate an HTML table with the fetched data
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>";
foreach ($rows as $row) {
    echo "<tr><td>".$row['id']."</td><td>".$row['Name']."</td><td>".$row['Email']."</td><td>".$row['phone']."</td></tr>";
}
echo "</table>";

// Close the MySQL connection
mysqli_close($conn);
?>
