
<html>
<head>
	<title>Select Table and Display Data</title>
</head>
<body>
	<?php
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
		$tables = array();
		// Get all tables from the database
		$result = $conn->query("SHOW TABLES");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_row()) {
				$tables[] = $row[0];
			}
		}
		$conn->close();
	?>
	<form action="" method="post">
		<label for="table_name">Select table:</label>
		<select id="table_name" name="table_name" required>
			<option value="">Select table</option>
			<?php foreach($tables as $table) { ?>
				<option value="<?php echo $table ?>"><?php echo $table ?></option>
			<?php } ?>
		</select>
		<br>
		<input type="submit" name="submit" value="Display Data">
	</form>
	<?php
		if(isset($_POST['submit'])) {
			$table_name = $_POST['table_name'];
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			// SQL query to retrieve data from the selected table
			$sql = "SELECT * FROM ".$table_name;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// Output data of each row
				echo "<table>";
				echo "<tr>";
				// Output column names in the table header
				while($fieldinfo=mysqli_fetch_field($result))
				{
					echo "<th>".ucwords($fieldinfo->name)."</th>";
				}
				echo "</tr>";
			    while($row = $result->fetch_assoc()) {
			    	echo "<tr>";
			    	foreach($row as $key => $value) {
			        	echo "<td>".$value."</td>";
			    	}
			    	echo "</tr>";
			    }
			    echo "</table>";
			} else {
			    echo "0 results";
			}
			$conn->close();
		}
		
		
		session_start();
$sam = $_SESSION['dawilly'];
echo $sam;
	?>
</body>
</html>
