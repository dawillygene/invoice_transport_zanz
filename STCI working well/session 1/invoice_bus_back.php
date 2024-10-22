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
					<li><a href="invoice_bus_front.php"><i class="fa fa-file-pdf-o fa-fw"></i> Front</a></li>
					<li class="active"><a href="#"><i class="fa fa-file-pdf-o fa-fw "></i> Back</a></li>


	</nav>
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>
    

 










	
	
	
	
	
	
	
	
	
	
	
	<table  id="inventory" class="inventory">
			<thead>
				<tr>
					<th><span contenteditable="">Date</span></th>
					<th><span id="prefix" contenteditable="">Big Bus</span></th>
					<th><span contenteditable="">Min Bus</span></th>
				</tr>
			</thead>
			<tbody>
				<form action="#" method="POST">
				<tr>
					<td><span ><input type="date" name="date1" class="ontable" size="30"></span></td>
					<td><span ><input type="text" name="big_bus1" class="ontable" size="30"></span></td>
					<td><span ><input type="text" name="min_bus1" class="ontable" size="30"></span></td>
				</tr>
				<tr>
					<td><span ><input type="submit" name="submit_data" class="save"></span></td>
					<td><span ></span></td>
					<td><span ></span></td>
				</tr>
				 </form>
			</tbody>
		</table>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php


// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Invoice";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tables = [];
// Get all tables from the database
$result = $conn->query("SHOW TABLES");
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
			<option value="">Select table</option>
			<?php foreach ($tables as $table) { ?>
				<option value="<?php echo $table; ?>"><?php echo $table; ?></option>
			<?php } ?>
		</select>
		<br>
		<input type="submit" name="submit_choice" value="Display Data">
</form>
	
	


<?php
session_start();
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Invoice";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	
	
	
if (isset($_POST["submit_data"]))  {
    // Get the values from the form
   $table_name = $_SESSION['tena'];
    $date1 = $_POST['date1'];
    $big_bus1 = $_POST['big_bus1'];
    $min_bus1 = $_POST['min_bus1'];
    
    $sql = "INSERT INTO " . $table_name . " (date, big_bus, min_bus) VALUES ('$date1', '$big_bus1', '$min_bus1')";
    if(mysqli_query($conn, $sql)) {
        echo '<script>alert("Values inserted successfully!.")</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    //header('Location:buses.php');

  
 }
	
	
	
else if(isset($_POST["submit_choice"])) {
     $table_name = $_POST["table_name"];
     $_SESSION['tena'] = $table_name;
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     // SQL query to retrieve data from the selected table
     $sql = "SELECT * FROM " . $table_name;
     $result = $conn->query($sql);
 }  

	else
	{
	
		
		}
		
 $sql = "SELECT * FROM " . $table_name;
 $result = mysqli_query($conn, $sql);

 // Generate the HTML table with classes
 if (mysqli_num_rows($result) > 0) {
     echo '<table class="inventory">';
     echo "<thead>";
     echo '<tr><th><span class="prefix" contenteditable>Date</span></th><th><span contenteditable>Big Bus</span></th><th><span contenteditable>Min Bus</span></th></tr>';
     echo "</thead>";
     echo "<tbody>";
     while ($row = mysqli_fetch_assoc($result)) {
     echo "<tr>";
     echo '<td><a class="cut">-</a><span contenteditable>' .
             $row["date"] .
             "</span></td>";
     echo "<td><span contenteditable>" . $row["big_bus"] . "</span></td>";
     echo "<td><span contenteditable>" . $row["min_bus"] . "</span></td>";
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo '<table class="balance">';
     echo "<tbody>";
     echo "<tr>";
     echo '<th><span contenteditable="">Big Bus</span></th>';
     echo "<td><span></span></td>";
     echo "</tr>";
     echo "<tr>";
     echo '<th><span contenteditable="">Min Bus</span></th>';
     echo "<td><span></span><span></span></td>";
     echo "</tr>";
     echo "</tbody>";
     echo "</table>";
 } else {
     echo "There is no any Entry";
 }

mysqli_close($conn); 
		
		
		
		
		
		
		
		
		

?>
<div class="printed"><a href="backprint.php">print</a> </div>










   </div> 
		</div>

	
	






	<script>
		
	
  /* 
  
   <button class="save" id="save">Save</button>
  document.getElementById("save").addEventListener("click", function() {
        // Get the data from the table
        var table = document.getElementById("inventory");
        var rows = table.getElementsByTagName("tr");
        var data = [];
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName("td");
            var rowData = {};
            rowData.date = cells[0].innerText;
            rowData.big_bus = cells[1].innerText;
            rowData.min_bus = cells[2].innerText;
            data.push(rowData);
        }

        // Send an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open("POST","save.php");
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
            } else {
                alert("Error: " + xhr.statusText);
            }
        };
        xhr.send(JSON.stringify(data));
    });	
		*  /
	
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

			emptyColumn.innerHTML = '<td><a class="cut">-</a><span contenteditable ></span></td>' +
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
			var total = -130;
			var total1 = -130;
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

			if (window.addEventListener) {
				document.addEventListener('click', onClick);
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
