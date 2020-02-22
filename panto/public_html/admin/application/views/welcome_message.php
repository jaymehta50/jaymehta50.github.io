<!DOCTYPE HTML>
<head>
	<title>Addenbrooke's Pantomime:echo  Wizard of Obs</title>
	<style>
		th {
			font-weight: bold;
			border: 1px solid #000000;
			cursor: pointer;
		}
		table {
			border-collapse: collapse;
		}
		td {
			border: 1px solid #000000;
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
	<a href="http://www.addies-panto.co.uk/admin/welcome/dvd_orders/">View DVD Orders</a><br />
	<a href="http://www.addies-panto.co.uk/admin/email/">Send a Panto Email</a><br />
	<a href='http://www.addies-panto.co.uk/admin/welcome/download_csv/' target='_blank'>Download as Spreadsheet</a><br /><br />
	<table id="mytable" class="tablesorter">
		<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email Address</th>
			<th>Telephone Number</th>
			<th>College</th>
			<th>Comments</th>
			<th>Acting</th>
			<th>Singing</th>
			<th>Dancing</th>
			<th>Orchestra & Instrument</th>
			<th>Chorus</th>
			<th>Backstage & Tech</th>
			<th>Makeup, Costumes and Props</th>
			<th>Audition Time</th>
			<th>Audition Date</th>
			<th>Audition Location</th>
		</tr>
		</thead>
		<tbody>
		<?php
			foreach($auditionees as $aud) {
				$temp = str_split($aud['tel']);
				echo "<tr><td>".$aud['first_name']."</td>";
				echo "<td>".$aud['last_name']."</td>";
				echo "<td><a href='mailto:".$aud['email']."'>".$aud['email']."</a></td>";
				echo "<td><a href='tel:";
				if($temp[0]=="4" AND $temp[1]=="4") echo "+";
				echo $aud['tel']."'>".$aud['tel']."</a></td>";
				echo "<td>".$aud['college']."</td>";
				echo "<td><textarea readonly='readonly'>".$aud['comments']."</textarea></td>";
				echo "<td ";
					if ($aud['acting']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['acting']==1) echo "Yes";
					else echo "No";
				echo "</td>";
				echo "<td ";
					if ($aud['singing']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['singing']==1) echo "Yes";
					else echo "No";
				echo "</td>";
				echo "<td ";
					if ($aud['dancing']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['dancing']==1) echo "Yes";
					else echo "No";
				echo "</td>";
				echo "<td ";
					if ($aud['orchestra']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['orchestra']==1) echo "Yes - ".$aud['instrument'];
					else echo "No";
				echo "</td>";
				echo "<td ";
					if ($aud['chorus']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['chorus']==1) echo "Yes";
					else echo "No";
				echo "</td>";
				echo "<td ";
					if ($aud['tech']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['tech']==1) echo "Yes";
					else echo "No";
				echo "</td>";
				echo "<td ";
					if ($aud['makeup']==1) echo "class='green'";
					else echo "class='red'";
				echo ">";
					if ($aud['makeup']==1) echo "Yes";
					else echo "No";
				echo "</td>";
				echo "<td>";
					if ($aud['slot_id']==0) echo "N/A";
					else echo date("H:i",strtotime($aud['time']));
				echo "</td>";
				echo "<td>";
					if ($aud['slot_id']==0) echo "N/A";
					else echo date("jS M Y",strtotime($aud['date']));
				echo "</td>";
				echo "<td>";
					if ($aud['slot_id']==0) echo "N/A";
					else echo $aud['location'];
				echo "</td></tr>";
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