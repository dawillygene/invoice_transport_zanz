<?php

class dbConfig{
	protected $servername;
	protected $username;
	protected $password;
	protected $dbname;
	
	function dbConfig(){
		
		$this -> servername = 'localhost';
		$this -> username   = 'root';
		$this -> password   = '';
		$this -> dbname     = 'Invoices';		
		}
	
	
	$conn = mysql_connect($servername ,$username ,$password ,$dbname);
	 
	 if(!$conn){
		 die("connection failed ." .mysql_error());
		 }
	
	}







$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Invoice";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>


?>
