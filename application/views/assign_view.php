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


	</style>

</head>
<body>

	<div style="text-align:center;width:1500px;height:3200px;">
		<div>
			<form action="show_db" method="POST" accept-charset="utf-8">
				<input type="submit" name="" value="回首頁">
			</form>
		</div>
		<div style="background-color:#FFAFFE;width:500px;height:3150px;margin:0 auto;">
			<table>
				<thead>
					<tr>
						<th></th>
						<th><h1>名單分發</h1></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					//print_r($table_source);
					//print_r($table_employee);
					for ($i=0; $i < count($table_source); $i++) { ?>
						<tr>
						<form action="assign_view_submit" method="POST" accept-charset="utf-8">
							<td>
								<?php echo $table_source[$i]['來源']; ?>
								<input type="hidden" name="source_name" value="<?php echo $table_source[$i]['來源']; ?>">
							</td>
							<td value=""><?php echo '共'.$table_source[$i]['未分配筆數'].'筆'; ?></td>
							<td></td>
							<td>
								前面					
								<select name="source_amount">
									<option value="100">100</option>
									<option value="200">200</option>
									<option value="300">300</option>
								</select>
								筆
							</td>
							<td>
								<select name="employee_name">
									<?php
									for ($j=0; $j < count($table_employee); $j++) { ?>
										<option value="<?php echo $table_employee[$j]['user_name'];?>"><?php echo $table_employee[$j]['user_name'];?></option>}
									option
									<?php }
									?>
								</select>
							</td>
							<td><input type="submit" name="" value="確認"></td>
						</form>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>


</body>
</html>