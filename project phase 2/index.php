<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filling form</title>
<style>
table {
  border: 1px solid black;	
  border-collapse: collapse;
}

th {

	border: 1px solid black;
	padding: 4px;
}

td {
	border: 1px solid black;
	padding: 4px;
}


</style>

</head>
<body>
    <form action="form.php" method="POST">
        <label for="name">Name:</label> <br>
        <input type="text" id="name" name="name" ><br><br>
      
        <label for="email">Email:</label> <br> 
        <input type="text" id="email" name="email" > <br> <br>
        <label for="phone">Phone:</label> <br>
        <input type="tel" id="phone" name="phone" > <br> <br>
		<label for="password">password :</label> <br>
		<input type="password" name="pass" id="password" > <br> <br>
		<input type="submit" > 
		
	    <button type="submit">Add Row</button> <br>
      </form>
      <hr>
      <table id="myTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>


<section>
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
$sql = "SELECT id, Name, Email, phone FROM mydatabase";
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
	</section>

	  
<script>

const form = document.getElementById('myForm');
const table = document.getElementById('myTable').getElementsByTagName('tbody')[0];

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const phone = document.getElementById('phone').value;
  
  
  const row = table;
  const newRow = table.insertRow();
  newRow.insertCell(0).innerText = name;
  newRow.insertCell(1).innerText = email;
  newRow.insertCell(2).innerText = phone;


  const deleteButton = document.createElement('button');
  deleteButton.innerText = 'Delete';
  deleteButton.addEventListener('click', () => {
    table.deleteRow(row.rowIndex);
  });

  newRow.insertCell(3).appendChild(deleteButton);

  form.reset();
});


      </script>
</body>
</html>
