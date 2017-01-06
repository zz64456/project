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
	
		?>


		<form action="show_db" method="POST" name="" style= "display:inline">
			<input type="text" name="keyword" value="">
			<input type="submit" name="" value="搜尋">
		</form>


	</div>

</div>

</body>
</html>