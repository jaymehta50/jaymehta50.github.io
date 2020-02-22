<!DOCTYPE HTML>
<head>
	<title>Addenbrooke's Pantomime:echo  Peter Pancreas</title>
	<style>
		th {
			font-weight: bold;
			border: 1px solid #000000;
			cursor: pointer;
			padding: 5px;
		}
		table {
			border-collapse: collapse;
		}
		td {
			border: 1px solid #000000;
			padding: 5px;
		}
		td.green {
			background-color: #1ec929;
		}
		td.red {
			background-color: #ff0000;
		}
	</style>
</head>

<body>
	<a href='http://www.addies-panto.co.uk/admin/welcome/download_dvd_csv/' target='_blank'>Download as Spreadsheet</a><br /><br />
	<table id="mytable" class="tablesorter">
		<thead>
		<tr>
			<th>Reference</th>
			<th>Name</th>
			<th>Email Address</th>
			<th>Number of DVDs</th>
			<th>Total Price</th>
			<th>Comments</th>
		</tr>
		</thead>
		<tbody>
		<?php
			foreach($orders as $aud) {
				echo "<tr><td>".$aud['reference']."</td>";
				echo "<td>".$aud['contact_name']."</td>";
				echo "<td>".$aud['contact_email']."</td>";
				echo "<td>".$aud['no_dvds']."</td>";
				echo "<td>&#163;".number_format($aud['total_price'],2)."</td>";
				echo "<td>".$aud['comments']."</td></tr>";
			}
		?>
		</tbody>
	</table>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src='./assets/jquery_tablesorter/jquery.tablesorter.min.js'></script>
	<script>
		$(document).ready(function() 
		    { 
		        $("#mytable").tablesorter(); 
		    } 
		); 
	</script>
</body>
</html>