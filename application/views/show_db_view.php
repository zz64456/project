<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>


<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Search</title>

	<script src="Win/js/jquery-3.1.1.min"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

	<h1></h1>

	<div id="body">

		<?php 

		echo "使用者帳號:".$_SESSION['user_name']."<br><br>";

		if (isset($keyword)) {
			echo "搜尋: <b>".$keyword."</b>";
		}

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
				<input type="submit" name="" value="原檔搜尋">
			</form>
		</div>

		<div align="center">
			<form action="show_all_number_processed" method="POST" name="" style= "display:inline">
				<input type="text" name="keyword" value="">
				<input type="submit" name="" value="單一搜尋">
			</form>
		</div>


		<!-- 下載按鈕 -->
		<form action="download_excel" method="POST">
			<input type="submit" name="action" value="下載EXCEL">
			<?php if (isset($keyword)) { ?>
				<?php //echo $original_or_processed."<br>".$keyword; ?>
				<input type="hidden" name="original_or_processed" value="<?php echo $original_or_processed; ?>">
				<input type="hidden" name="download_keyword" value="<?php echo $keyword; ?>">
			<?php } ?>
		</form>
		

		<br><br>


		<table style="width:100%" border="1" >
			<tr>
				<th nowrap="nowrap">編號</th>
				<th nowrap="nowrap">姓名</th>
				<th nowrap="nowrap">日期</th>
				<th nowrap="nowrap">買賣</th>
				<th nowrap="nowrap">股票</th>
				<th nowrap="nowrap">LINE</th>
				<th nowrap="nowrap">電話</th>
				<th nowrap="nowrap">手機1</th>
				<th nowrap="nowrap">手機2</th>
				<th nowrap="nowrap">價位</th>
				<th nowrap="nowrap">張數</th>
				<th nowrap="nowrap">來源</th>
				<th nowrap="nowrap">身分證</th>
				<th nowrap="nowrap">更多</th>
			</tr>

			<?php 
			
			if (isset($data)) {
				for ($i=0; $i<count($data); $i++) {
					echo "<tr>";
					echo "<td>".$data[$i]['id']."</td>";
					echo "<td>".$data[$i]['customer_name']."</td>";
					echo "<td>".$data[$i]['日期']."</td>";
					echo "<td>".$data[$i]['買賣']."</td>";
					echo '<td nowrap="nowrap">'.$data[$i]['company_name']."</td>";
					echo "<td>".$data[$i]['LINE']."</td>";
					echo '<td nowrap="nowrap">'.$data[$i]['電話']."</td>";
					echo "<td>".$data[$i]['手機1']."</td>";
					echo "<td>".$data[$i]['手機2']."</td>";
					echo "<td>".$data[$i]['價位']."</td>";
					echo "<td>".$data[$i]['張數']."</td>";
					echo "<td>".$data[$i]['來源']."</td>";
					echo "<td>".$data[$i]['身分證字號']."</td>";
			?>
					<td nowrap="nowrap"><a href="#" onclick="window.open(' show_notes?id=<?php echo $data[$i]['id']; ?> ', '畚箕', config='height=600,width=1000');">更多</a></td>
			<?php
					echo "</tr>";
				}
			}
			
			?>
		</table>

	</div>

</div>

</body>
</html>