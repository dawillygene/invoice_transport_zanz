<?php

// Connect to the MySQL database
require('db/Invoices.php');
$data = json_decode(file_get_contents("php://input"), true);

// Insert the invoice data into the database
$invoiceNumber = $data['invoiceNumber'];
$date = $data['date'];
$orderNumber = $data['orderNumber'];
$amountDue = $data['amountDue'];
$accountName = $data['accountName'];
$accountNumber = $data['accountNumber'];
$tinNumber = $data['tinNumber'];
$ownerAddress = $data['recipientname'];
$recipientAddress = $data['recipientaddress'];
//echo $invoiceNumber;
//echo $date;
//echo $ownerAddress;
//echo $recipientAddress;

$sql = "INSERT INTO invoices (invoice_number, date, order_number, amount_due, account_name, account_number, tin_number,ownerAddress,recipientAddress) VALUES ('$invoiceNumber', '$date', '$orderNumber', '$amountDue', '$accountName', '$accountNumber', '$tinNumber','$ownerAddress ','$recipientAddress')";
//echo $sql;

if(mysqli_query($conn, $sql)) {
        echo '<script>alert("Invoice data inserted successfully!.")</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

// Get the ID of the last inserted invoice
$invoiceId = $conn->insert_id;

// Insert the item data into the database
foreach ($data['items'] as $item) {
    $name = $item['name'];
    $description = $item['description'];
    $rate = $item['rate'];
    $quantity = $item['quantity'];
    $price = $item['price'];

    $sql = "INSERT INTO invoice_items (invoice_id, name , description, rate, quantity, price ) VALUES ('$invoiceId','$name', '$description', '$rate', '$quantity','$price')";
    
  if(mysqli_query($conn, $sql)) {
       // echo '<script>alert("Invoice data inserted successfully 2!.")</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

  
}
       
    

// Close the database connection
$conn->close();

?>
