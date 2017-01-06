<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Search</title>

	<script type="text/javascript">  

		function loadXMLDoc() {
			var xmlhttp;
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			//xmlhttp.open("GET","demo_get2.asp?fname=Bill&lname=Gates",true);
			//xmlhttp.send();
		}






	</script>

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





<h2>AJAX</h2>
<button type="button" onclick="loadXMLDoc()">请求数据</button>
<div id="myDiv"></div>










<div id="container">

	<h1></h1>

	<div id="body">

		<?php 

		if (isset($data)) {
			echo "<br>";
			echo "資料筆數: ". count($data)."<br>";
		}
		else {
			echo "<br>";
			echo "目前無資料";
		}
	
		?>

		<div align="center">
			<form action="show_db" method="POST" name="" style= "display:inline">
			<input type="text" name="keyword" value="">
			<input type="submit" name="" value="搜尋">
			</form>
			<input type ="button" onclick="self.location.href='home'" value="回到上一頁" style= "display:inline"></input>
		</div>

		<br><br>

		<table style="width:100%">
			<tr>
				<th>編號</th>
				<th>姓名</th>
				<th>股票</th>
				<th>備註</th>
			</tr>

			<?php 
			
			if (isset($data)) {
				for ($i=0; $i<count($data); $i++) {
					echo "<tr>";
					echo "<td>".$data[$i]['id']."</td>";
					echo "<td>".$data[$i]['customer_name']."</td>";
					echo "<td>".$data[$i]['company_name']."</td>";
					echo "<td>".$data[$i]['備註']."</td>";
					echo "</tr>";
				}
			}
			
			?>

	</div>

</div>

</body>
</html>