<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Search</title>

	<script src="Win/js/jquery-3.1.1.min"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<script type="text/javascript">  

	</script>

	<style>

		.css_th2, .css_td2 {
      		background-color: #CFCFCF;
  		}
  		.css_notes {
  			width: 700px;
  			table-layout:fixed; word-wrap:break-word; word-break:break-all;
  		}
  		table {
  			border:1px black solid;
  		}
  		#content {
  			text-align:center;
  			margin: 0px auto;
  		}

	</style>

</head>
<body>

	<div id="content">
		<table>
				<?php 
				
				if (isset($data)) {
					for ($i=0; $i<count($data); $i++) {
				?>			
					<tr>
						<th nowrap="nowrap">編號</th><?php echo '<td nowrap="nowrap">'.$data[$i]['id']."</td>"; ?>
					</tr>
					<tr>
						<th class="css_th2" nowrap="nowrap">姓名</th><?php echo '<td class="css_td2" nowrap="nowrap">'.$data[$i]['customer_name']."</td>"; ?>
					</tr>
					<tr>
						<th nowrap="nowrap">手機</th><?php echo '<td nowrap="nowrap">'.$data[$i]['手機1']."</td>"; ?>
					</tr>
					<tr>
						<th class="css_th2" nowrap="nowrap">股票</th><?php echo '<td class="css_td2" nowrap="nowrap">'.$data[$i]['company_name']."</td>"; ?>
					</tr>
					<tr>
						<th nowrap="nowrap">帳號</th><?php echo '<td nowrap="nowrap">'.$data[$i]['帳號']."</td>"; ?>
					</tr>
					<tr>
						<th class="css_th2"  nowrap="nowrap">EMAIL</th><?php echo '<td class="css_td2" nowrap="nowrap">'.$data[$i]['EMAIL']."</td>"; ?>
					</tr>
					<tr>
						<th nowrap="nowrap">地址</th><?php echo '<td nowrap="nowrap">'.$data[$i]['地址']."</td>"; ?>
					</tr>
					<tr>
						<th class="css_th2">備註</th><?php echo '<td class="css_td2" class="css_notes">'.$data[$i]['備註']."</td>"; ?>
					</tr>


				<?php 
					}
				}
				
				?>

		</table>
	</div>





		<!--
		<table style="border:5px #cccccc solid; table-layout:fixed; word-wrap:break-word; word-break:break-all;" rules="all" cellpadding='5';>
			<tr>
				<td>q</td>
				<td>qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq</td>
			</tr>
			<tr>
				<td>q</td>
				<td>q</td>
			</tr>
			<tr>
				<td>q</td>
				<td>q</td>
			</tr>
			
		</table>
		-->








</body>
</html>