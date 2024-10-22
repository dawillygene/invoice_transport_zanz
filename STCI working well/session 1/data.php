<html>
<head>
	<title>Create Table</title>
</head>
<body>
	<?php
		if(isset($_POST['submit'])) {
			$table_name = $_POST['table_name'];
			//Replace with your database connection details
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "Invoice";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			// SQL query to create a new table
			$sql = "CREATE TABLE ".$table_name." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				email VARCHAR(50),
				reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
				)";
			if ($conn->query($sql) === TRUE) {
			    echo "Table created successfully";
			} else {
			    echo "Error creating table: " . $conn->error;
			}
			$conn->close();
		}
	?>
	<form action="" method="post">
		<label for="table_name">Enter table name:</label>
		<input type="text" id="table_name" name="table_name" required>
		<br>
		<input type="submit" name="submit" value="Create Table">
	</form>
</body>
</html>
