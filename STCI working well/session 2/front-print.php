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
require('db/Invoices.php');
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

	<script>
		
	
		/* Shivving (IE8 is not supported, but at least it won't look as awful)
/* ========================================================================== */

		(function (document) {
			var
				head = document.head = document.getElementsByTagName('head')[0] || document.documentElement,
				elements =
				'article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output picture progress section summary time video x'
				.split(' '),
				elementsLength = elements.length,
				elementsIndex = 0,
				element;

			while (elementsIndex < elementsLength) {
				element = document.createElement(elements[++elementsIndex]);
			}

			element.innerHTML = 'x<style>' +
				'article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}' +
				'audio[controls],canvas,video{display:inline-block}' +
				'[hidden],audio{display:none}' +
				'mark{background:#FF0;color:#000}' +
				'</style>';

			return head.insertBefore(element.lastChild, head.firstChild);
		})(document);

		/* Prototyping
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

			emptyColumn.innerHTML = '<td><a class="cut">-</a><span contenteditable >2023</span></td>' +
				'<td><span contenteditable></span></td>' +
				'<td><span contenteditable></span></td>';

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




	/* Update Invoice
		/* ========================================================================== */

		function updateInvoice() {
			var total = 0;
			var total1 = 0;
			var cells, price1,price2, total,total1, a, i;

			// update inventory cells
			// ======================

			for (var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i) {
				cells = a[i].querySelectorAll('span:last-child');
            	price1 = parseFloatHTML(cells[1])
				price2 = parseFloatHTML(cells[2])
				// add price to total
			//	total += price;
				total += price1;
				total1 +=price2;

				// set row total
				//cells[4].innerHTML = price;
			}

			// update balance cells
			// ====================

			// get balance cells
			cells = document.querySelectorAll('table.balance td:last-child span:last-child');

			// set total
			cells[0].innerHTML = total;
			cells[1].innerHTML = total1;

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

			
		}

		window.addEventListener && document.addEventListener('DOMContentLoaded', onContentLoad);
	</script>



</body>
</html>




