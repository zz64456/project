<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Search</title>

	<style>
		table {
		    font-family: arial, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		}

		td, th {
		    border: 1px solid #dddddd;
		    text-align: left;
		    padding: 8px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}
</style>

</head>
<body>

<div id="container">
	<h1>Search</h1>

	<div id="body">
		<?php 

		echo "<br><br>";
		echo "資料筆數: ". count($data);
	
		?>

		<br><br>

		<table style="width:100%">
			<tr>
				<th>姓名</th>
				<th>手機2</th>
				<th>EMAIL</th>
				<th>帳號</th>
				<th>地址</th>
				<th>備註</th>
			</tr>


			<form action="show_db2" method="POST" name="" style= "display:inline">
			<input type="text" name="customer_id" value="<?php echo $_GET['id']; ?>">
			<input type="submit" name="" value="搜尋">
		</form>

			<?php 

			echo $_GET['id']."<br>";


			print_r($data);
			if ($data!=null) {
				for ($i=0; $i<count($data); $i++) {
					echo "<tr>";
					echo "<td>".$data[$i]['customer_name']."</td>";
					echo "<td>".$data[$i]['手機2']."</td>";
					echo "<td>".$data[$i]['EMAIL']."</td>";
					echo "<td>".$data[$i]['帳號']."</td>";
					echo "<td>".$data[$i]['地址']."</td>";
					echo "<td>".$data[$i]['備註']."</td>";
					echo "</tr>";
				}
			}
			
			?>

	</div>

</div>

</body>
</html>