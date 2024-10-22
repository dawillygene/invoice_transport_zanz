<!DOCTYPE html>
<html lang="en" foxified="">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" href="style2.css">
	<link rel="stylesheet" href="style.css">
<style>
.ontable {
    border: 2px solid rgba(0, 0, 0, 0);
    padding: 0.1px;
 
  }
  .printed{
	border-width: 1px;
			display: block;
			font-size: 1.2rem;
			padding: 0.25em 0.5em;
			float: left;
			text-align: center;
			width: 4.3em;
			background: black;
			box-shadow: 0 1px 2px rgb(251, 255, 0);;
			background-image: -moz-linear-gradient(black);
			background-image: -webkit-linear-gradient(#e9e9e9 5%, #ffffff 100%);
			border-radius: 0.5em;
			border-color: black;
			color: #f8ed14;
			cursor: pointer;
			font-weight: bold;
			text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
	
	
	         }
</style>

	<title>Salum Transport Invoice</title>

</head>

<body>
	<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html">STCI Admin v1.0</a> <!-- salum transport company invoices -->
		</div>


		<!-- /.navbar-top-links-->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<li class="sidebar-search">
						<div class="input-group custom-search-form">


						</div>
						<!-- /input-group-->

					<li><a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
					<li class="active"><a href="/"><i class="fa fa-file-pdf-o fa-fw"></i> Front</a></li>
					<li ><a href="invoice_bus_back.php"><i class="fa fa-file-pdf-o fa-fw "></i> Back</a></li>


	</nav>
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>
    
<?php

session_start();


// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Invoices";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tables = [];
// Get all tables from the database
$result = $conn->query("SELECT invoice_number FROM invoices");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
}
$conn->close();
?>


<form action="" method="POST">
		<label for="table_name">Select table:</label>
		<select id="table_name" name="table_name" >
			<option value="">Select Invoice</option>
			<?php foreach ($tables as $table) { ?>
				<option value="<?php echo $table; ?>"><?php echo $table; ?></option>
			<?php } ?>
		</select>
		<br>
		<input type="submit" name="submit_choice" value="Display Data">
</form>
	
	
<?php
// Connect to the MySQL database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Invoices';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit_choice"])) {
     $table_name = $_POST["table_name"];
     $_SESSION['front'] = $table_name;
     echo $table_name;
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
 }
    $print_once = true; 
   
$sql = "SELECT invoices.*, invoice_items.name, invoice_items.description, invoice_items.rate, invoice_items.quantity, invoice_items.price 
FROM invoices 
JOIN invoice_items 
ON invoices.id = invoice_items.invoice_id 
WHERE invoices.invoice_number = '" . $table_name . "'";

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




session_start();
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
echo '					<td><span data-prefix="">Tsh.</span><span>21,700,000.00</span></td>';
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


    }
    
// Close the database connection
$conn->close()
?>


<button class="save" id="save">Save</button>
<hr>
<div class="printed"><a href="backprint.php">print</a> </div>






<script>
	
	
document.getElementById("save").addEventListener("click", function() {
	  
// Get references to the HTML tables
const inventoryTable = document.getElementById('inventory');
const itemsTable = document.getElementById('items');
const balancesTable = document.getElementById('balances');
const paymentsTable = document.getElementById('payments');
const ownerAddress = document.getElementById('owner');
const recipientAddress = document.getElementById('Recipient');



// Define the data object to be sent to the server
const data = {
  invoiceNumber: inventoryTable.rows[0].cells[1].innerText,
  date: inventoryTable.rows[1].cells[1].innerText,
  orderNumber: inventoryTable.rows[2].cells[1].innerText,
  amountDue: balancesTable.rows[0].cells[1].innerText,
  items: [],
  accountName: paymentsTable.rows[0].cells[1].innerText,
  accountNumber: paymentsTable.rows[1].cells[1].innerText,
  tinNumber: paymentsTable.rows[2].cells[1].innerText,
  ownername: ownerAddress.getElementsByTagName('p')[0].innerText,
  owneremail: ownerAddress.getElementsByTagName('p')[1].innerText,
  owneraddress: ownerAddress.getElementsByTagName('p')[2].innerText,
  recipientname: recipientAddress.getElementsByTagName('p')[0].innerText,
  recipientaddress: recipientAddress.getElementsByTagName('p')[1].innerText,
  recipientphone: recipientAddress.getElementsByTagName('p')[2].innerText
};


// Loop through the items table and add each item to the data object
const itemsTableRows = itemsTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
for (let i = 0; i < itemsTableRows.length; i++) {
  const item = {
    name: itemsTableRows[i].getElementsByTagName('td')[0].innerText,
    description: itemsTableRows[i].getElementsByTagName('td')[1].innerText,
    rate: itemsTableRows[i].getElementsByTagName('td')[2].innerText,
    quantity: itemsTableRows[i].getElementsByTagName('td')[3].innerText,
    price: itemsTableRows[i].getElementsByTagName('td')[4].innerText
  };
  data.items.push(item);
}

/*
const ownerData = {
  ownername: ownerAddress.getElementsByTagName('p')[0].innerText,
  owneremail: ownerAddress.getElementsByTagName('p')[1].innerText,
  owneraddress: ownerAddress.getElementsByTagName('p')[2].innerText
};

const recipientData = {
  recipientname: recipientAddress.getElementsByTagName('p')[0].innerText,
  recipientaddress: recipientAddress.getElementsByTagName('p')[1].innerText,
  recipientphone: recipientAddress.getElementsByTagName('p')[2].innerText
};
*/


var xhr = new XMLHttpRequest();
        xhr.open("POST","save.php",true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
            } else {
                alert("Error: " + xhr.statusText);
            }
        };
xhr.send(JSON.stringify(data));
//xhr.send(JSON.stringify(ownerData));  
//xhr.send(JSON.stringify(recipientData));      
    });	
    
		/* ========================================================================== */

		(function (window, ElementPrototype, ArrayPrototype, polyfill) {
			function NodeList() {
				[polyfill]
			}
			NodeList.prototype.length = ArrayPrototype.length;

			ElementPrototype.matchesSelector = ElementPrototype.matchesSelector ||
				ElementPrototype.mozMatchesSelector ||
				ElementPrototype.msMatchesSelector ||
				ElementPrototype.oMatchesSelector ||
				ElementPrototype.webkitMatchesSelector ||
				function matchesSelector(selector) {
					return ArrayPrototype.indexOf.call(this.parentNode.querySelectorAll(selector), this) > -1;
				};

			ElementPrototype.ancestorQuerySelectorAll = ElementPrototype.ancestorQuerySelectorAll ||
				ElementPrototype.mozAncestorQuerySelectorAll ||
				ElementPrototype.msAncestorQuerySelectorAll ||
				ElementPrototype.oAncestorQuerySelectorAll ||
				ElementPrototype.webkitAncestorQuerySelectorAll ||
				function ancestorQuerySelectorAll(selector) {
					for (var cite = this, newNodeList = new NodeList; cite = cite.parentElement;) {
						if (cite.matchesSelector(selector)) ArrayPrototype.push.call(newNodeList, cite);
					}

					return newNodeList;
				};

			ElementPrototype.ancestorQuerySelector = ElementPrototype.ancestorQuerySelector ||
				ElementPrototype.mozAncestorQuerySelector ||
				ElementPrototype.msAncestorQuerySelector ||
				ElementPrototype.oAncestorQuerySelector ||
				ElementPrototype.webkitAncestorQuerySelector ||
				function ancestorQuerySelector(selector) {
					return this.ancestorQuerySelectorAll(selector)[0] || null;
				};
		})(this, Element.prototype, Array.prototype);

		/* Helper Functions
		/* ========================================================================== */

		function generateTableRow() {
			var emptyColumn = document.createElement('tr');

			emptyColumn.innerHTML = '<td><a class="cut">-</a><span contenteditable></span></td>' +
				'<td><span contenteditable></span></td>' +
				'<td><span data-prefix></span><span contenteditable>0.00</span></td>' +
				'<td><span contenteditable>0</span></td>' +
				'<td><span data-prefix></span><span>0.00</span></td>';

			return emptyColumn;
		}

		function parseFloatHTML(element) {
			return parseFloat(element.innerHTML.replace(/[^\d\.\-]+/g, '')) || 0;
		}

		function parsePrice(number) {
			return number.toFixed(2).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1,');
		}

		/* Update Number
		/* ========================================================================== */

		function updateNumber(e) {
			var
				activeElement = document.activeElement,
				value = parseFloat(activeElement.innerHTML),
				wasPrice = activeElement.innerHTML == parsePrice(parseFloatHTML(activeElement));

			if (!isNaN(value) && (e.keyCode == 38 || e.keyCode == 40 || e.wheelDeltaY)) {
				e.preventDefault();

				value += e.keyCode == 38 ? 1 : e.keyCode == 40 ? -1 : Math.round(e.wheelDelta * 0.025);
				value = Math.max(value, 0);

				activeElement.innerHTML = wasPrice ? parsePrice(value) : value;
			}

			updateInvoice();
		}



// Time and date addition

function updateDate() {
  var currentDate = new Date();
  var dateString = currentDate.toLocaleDateString();
  var timeString = currentDate.toLocaleTimeString();
  var dateTimeString = dateString; //+ ' ' + timeString;
  document.getElementById('date').innerHTML = dateTimeString;
}
     setInterval(updateDate, 100);


	/* Update Invoice
		/* ========================================================================== */

		function updateInvoice() {
			var total = 0;
			var cells, price, total, a, i;

			// update inventory cells
			// ======================

			for (var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i) {
				// get inventory row cells
				cells = a[i].querySelectorAll('span:last-child');

				// set price as cell[2] * cell[3]
				price = parseFloatHTML(cells[2]) * parseFloatHTML(cells[3]);

				// add price to total
				total += price;

				// set row total
				cells[4].innerHTML = price;
			}

			// update balance cells
			// ====================

			// get balance cells
			cells = document.querySelectorAll('table.balance td:last-child span:last-child');

			// set total
			cells[0].innerHTML = total;

			// set balance and meta balance
			cells[2].innerHTML = document.querySelector('table.meta tr:last-child td:last-child span:last-child').innerHTML =
				parsePrice(total - parseFloatHTML(cells[1]));

			// update prefix formatting
			// ========================

			var prefix = document.querySelector('#prefix').innerHTML;
			for (a = document.querySelectorAll('[data-prefix]'), i = 0; a[i]; ++i) a[i].innerHTML = prefix;

			// update price formatting
			// =======================

			for (a = document.querySelectorAll('span[data-prefix] + span'), i = 0; a[i]; ++i)
				if (document.activeElement != a[i]) a[i].innerHTML = parsePrice(parseFloatHTML(a[i]));
		}

		/* On Content Load
		/* ========================================================================== */

		function onContentLoad() {
			updateInvoice();

			var
				input = document.querySelector('input'),
				image = document.querySelector('img');

			function onClick(e) {
				var element = e.target.querySelector('[contenteditable]'),
					row;

				element && e.target != document.documentElement && e.target != document.body && element.focus();

				if (e.target.matchesSelector('.add')) {
					document.querySelector('table.inventory tbody').appendChild(generateTableRow());
				} else if (e.target.className == 'cut') {
					row = e.target.ancestorQuerySelector('tr');

					row.parentNode.removeChild(row);
				}

				updateInvoice();
			}

			function onEnterCancel(e) {
				e.preventDefault();

				image.classList.add('hover');
			}

			function onLeaveCancel(e) {
				e.preventDefault();

				image.classList.remove('hover');
			}

			function onFileInput(e) {
				image.classList.remove('hover');

				var
					reader = new FileReader(),
					files = e.dataTransfer ? e.dataTransfer.files : e.target.files,
					i = 0;

				reader.onload = onFileLoad;

				while (files[i]) reader.readAsDataURL(files[i++]);
			}

			function onFileLoad(e) {
				var data = e.target.result;

				image.src = data;
			}

			if (window.addEventListener) {
				document.addEventListener('click', onClick);

				document.addEventListener('mousewheel', updateNumber);
				document.addEventListener('keydown', updateNumber);

				document.addEventListener('keydown', updateInvoice);
				document.addEventListener('keyup', updateInvoice);

				input.addEventListener('focus', onEnterCancel);
				input.addEventListener('mouseover', onEnterCancel);
				input.addEventListener('dragover', onEnterCancel);
				input.addEventListener('dragenter', onEnterCancel);

				input.addEventListener('blur', onLeaveCancel);
				input.addEventListener('dragleave', onLeaveCancel);
				input.addEventListener('mouseout', onLeaveCancel);

				input.addEventListener('drop', onFileInput);
				input.addEventListener('change', onFileInput);
			}
		}

		window.addEventListener && document.addEventListener('DOMContentLoaded', onContentLoad);
</script>
	





</body>
</html>
