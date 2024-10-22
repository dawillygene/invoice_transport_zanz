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
	<header>
		<h1>Details</h1>
	</header>
	
	
	
<?php
require('db/Invoice.php');
session_start();
$table_name = $_SESSION['tena'];
$sql = "SELECT * FROM " . $table_name;
$result = mysqli_query($conn, $sql);




if (mysqli_num_rows($result) > 0) {
    echo '<table class="inventory">';
    echo '<thead>';
    echo '<tr><th><span class="prefix" contenteditable>Date</span></th><th><span contenteditable>Big Bus</span></th><th><span contenteditable>Min Bus</span></th></tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><a class="cut">-</a><span contenteditable>' . $row["date"] . '</span></td>';
        echo '<td><span contenteditable>' . $row["big_bus"] . '</span></td>';
        echo '<td><span contenteditable>' . $row["min_bus"] . '</span></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
     echo '<table class="balance">';
    echo '<tbody>';
    echo '<tr>';
    echo '<th><span contenteditable="">Big Bus</span></th>';
    echo '<td><span></span></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><span contenteditable="">Min Bus</span></th>';
    echo '<td><span></span><span></span></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '<a class="add">+</a>';
    echo '<aside>';
    echo '<h1><span ></h1>';
    echo '	</article>';
    echo '<button class="save"><a href="invoice_bus_back.php">back</a></button>';
   
    
    
} else {
   echo '<tr>';
        echo '<td><a class="cut">-</a><span contenteditable>' . $row["date"] . '</span></td>';
        echo '<td><span contenteditable>big_bus</span></td>';
        echo '<td><span contenteditable>min bus</span></td>';
        echo '</tr>';
}

mysqli_close($conn);
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
