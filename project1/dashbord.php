<?php
  session_start();
  
  if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['accountname'];
    
    echo  $username;
    echo  $user_id;
    
    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "", "mydatabase");
    
    // Check if connection was successful
    if(mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    // Prepare query to retrieve user information
    $query = "SELECT id,Name FROM mydatabase WHERE id='$user_id'";
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if($result && mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      echo "<h2>Welcome, $username !</h2>";
      echo "<p>Your user ID is: $user_id</p>";
      echo "<p>Your account was created on: " . $row['created_at'] . "</p>";
      echo "<p><a href='logout.php'>Logout</a></p>";
    } else {
      echo "Unable to retrieve user information.";
    }
  } else {
}
?>
