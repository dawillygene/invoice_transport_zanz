	<?php

			// require('db/Invoice.php');
			 $table_name = mysqli_real_escape_string($conn, $_POST['tablename']);
			 //echo $table_name; 
			 
			 
			 
			$sql = "CREATE TABLE $table_name (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				email VARCHAR(50),
				reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
				)";
				
				// echo $sql; 
				
			if(mysqli_query($conn, $sql)) {
   
      echo '<script type="text/javascript">
       window.onload = function () { alert("New Table created! "); } 
        </script>'; 
    
              } else {
        echo "Error: " . mysqli_error($conn);
            }
			$conn->close();
			
			//header('Location:invoice_bus_back.php');
		
	?>
