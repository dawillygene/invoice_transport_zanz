<!DOCTYPE html>
<html lang="en" foxified="">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="print.css">
		<title>Salum Transport Invoice</title>
	
		
</head>

<body>
<?php
session_start();
$table_name = $_SESSION['front'];

// Connect to the MySQL database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Invoices';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$print_once = true; 

$sql = "SELECT invoices.*, invoice_items.name, invoice_items.description, invoice_items.rate, invoice_items.quantity, invoice_items.price 
FROM invoices 
JOIN invoice_items 
ON invoices.id = invoice_items.invoice_id 
WHERE invoices.invoice_number ='" . $table_name . "'";
//'" . $table_name . "'
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} else {
	
    // Loop through the result set and output the data
    while ($row = mysqli_fetch_assoc($result)) {
		
		if($print_once){	
			
echo '	<header>';
echo '		<h1>Invoice</h1>';
echo '<address contenteditable="" id="owner">';
echo '<p> Salum Transport Company </p>';
echo '<p>office@salumtranspots.go.tz<br> 71203 Mwera Kigorofani, Zanzibar</p>';
echo '<p>(+255) 629 058 024</p>';
echo '</address>';
echo '<img src="logo.png" alt="" width="200px">';
echo '      </header>';
echo '     <article>';
echo '		<h1>Recipient</h1>';
echo '<address contenteditable="" id="Recipient">';
echo '<p>'. $row["ownerAddress"] . '</p>';
echo '<p>'. $row["recipientAddress"] . '</p>';
echo '<p>phone</p>';
echo '</address>';

			
			
			
			
			
	echo ' <table   id="inventory"  class="meta"> ';
	echo " <tbody> ";
	echo " <tr> ";
	echo ' <th><span contenteditable="">Invoice #</span></th> ';
	echo '<td><span contenteditable="">' . $row["invoice_number"] . '</span></td>';

	echo " </tr> ";	
	echo " <tr> ";		
	echo ' <th><span contenteditable="">Date</span></th> ';
	echo ' <td><span contenteditable=""><div id="date">' . $row["date"] . '</div></span></td> ';				
	echo " </tr> ";	
	echo " <tr> ";	
	echo ' <th><span contenteditable="">Order No.</span></th> ';
	echo ' <td><span contenteditable="">'. $row["order_number"] . '</span></td>';	
	echo " </tr> ";	
	echo " <tr> ";	
	echo ' <th><span contenteditable="">Amount Due</span></th>';
	echo ' <td><span id="prefix" contenteditable=""></span><span>'. $row["amount_due"] .'</span></td>';
	echo " </tr> ";	
	echo " </tbody>";	
	echo " </table>";
	

	
echo '<table id="items"  class="inventory">';
echo '    <thead>';
echo '        <tr>';
echo '            <th><span contenteditable="">Item</span></th>';
echo '            <th><span contenteditable="">Description</span></th>';
echo '            <th><span contenteditable="">Rate(Tsh)</span></th>';
echo '            <th><span contenteditable="">Quantity</span></th>';
echo '            <th><span contenteditable="">Price</span></th>';
echo '        </tr>';
echo '    </thead>';
echo '    <tbody>';
		
$print_once = false;
			}
			
echo '<tr>';
echo '<td><a class="cut">-</a><span contenteditable="">'. $row["name"] . '</span></td>';
echo '<td><span contenteditable="">'. $row["description"] .'</span></td>';
echo '<td><span data-prefix=""></span><span contenteditable="">'. $row["rate"] .'</span></td>';
echo '<td><span contenteditable="">'. $row["quantity"] .'</span></td>';
echo '<td><span data-prefix=""></span><span>'. $row["price"] .'</span></td>';
echo '</tr>';




//session_start();
$_SESSION['account_name'] = $row["account_name"] ;
$_SESSION['account_number'] = $row["account_number"];
$_SESSION['tin_number'] = $row["tin_number"];
	}
	
$row["account_name"] = $_SESSION['account_name'] ;
$row["account_number"] = $_SESSION['account_number'];
$row["tin_number"] =$_SESSION['tin_number'];
	
	
	
echo '	</tbody> ';
echo '		</table> ';
echo '		<a class="add">+</a> ';
echo '		<table id="balances" class="balance"> ';
echo ' <tbody>';
echo '				<tr>';
echo '					<th><span contenteditable="">Total</span></th>';
echo '					<td><span data-prefix="">Tsh.</span><span>0</span></td>';
echo '				</tr>';
echo '				<tr>';
echo '					<th><span contenteditable="">Amount Paid</span></th>';
echo '					<td><span data-prefix="">Tsh.</span><span contenteditable="">0.00</span></td>';
echo '				</tr>';
echo '				<tr>';
echo '					<th><span contenteditable="">Balance Due</span></th>';
echo '					<td><span data-prefix="">Tsh.</span><span>0</span></td>';
echo '				</tr>';
echo '			</tbody>';
echo '		</table>';
echo '		<table id ="payments" class="payment">';
echo '			<tbody>';
echo '				<tr>';
echo '					<th> <span contenteditable="">Account name :</span> </th>';
echo '					<td> <span contenteditable="">'. $row["account_name"] .'</span>';
echo '					</td>';
echo '				</tr>';
echo '				<tr>';
echo '					<th> <span contenteditable="">Account Number:</span> </th>';
echo '					<td> <span contenteditable="">'. $row["account_number"] .' </span></td>';
echo '				</tr>';
echo '				<tr>';
echo '					<th> <span contenteditable=""> TIN NO:</span></th>';
echo '					<td> <span contenteditable="">'. $row["tin_number"] .' </span></td>';
echo '				</tr>';
echo '			</tbody>';
echo '		</table>';
echo '	</article>';
echo '	<aside>';
echo '		<h1><span contenteditable="">Additional Notes</span></h1>';
echo '		<div contenteditable="">';
echo '			<p>The total amount due is divided into multiple payments, with a specified amount due at regular intervals.
			</p>';
echo '		</div>';
echo '	</aside>';
echo '<button class="save"><a href="invoice_bus_front.php">back</a></button>';

    }
    
// Close the database connection
$conn->close() 


?>

