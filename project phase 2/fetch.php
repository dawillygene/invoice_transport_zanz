<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";



// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection


if ($conn->connect_error) {
	
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, Name, Email FROM mydatabase";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
	
  // output data of each row............
  
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["Name"]. " " . $row["Email"]. "<br>";
   
   
    }
 }

else {
	
  echo "0 results";
  
}
$conn->close();
?>
