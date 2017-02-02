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
		.upload {
			float: right;
		}
		.download {
			float: left;
		}
		.information {
			width:300px;
			height:80px;
			float:left;
		}
		.button {
			width:1587px;
			height:80px;
			text-align:center;
			line-height:80px;
			text-align:center;
		}
	</style>


</head>
<body>

<div id="container">

	<h1 style="text-align:center;color:#008800;"><b>查詢系統</b></h1>

	<div id="body">
		<div>
			<div class="information">
				<?php 
				echo "使用者帳號:".$_SESSION['user_name']."<br><br>";
				?>

				<!-- 登出 -->
				<form action="logout" method="POST">
					<input type="submit" name="action" value="登出">
				</form>

				
			</div>
			
			<div class="button">
				<span style="color:red;"><b>(EX南山人壽請打南山)</b></span>
				<form action="show_db" method="POST" name="" style= "display:inline">
					<input type="text" name="keyword" value="">
					<input type="submit" name="" value="全部搜尋">
					<input type="hidden" name="search_type" value="1">
				</form>
				<form action="show_db" method="POST" name="" style= "display:inline">
					<input type="text" name="keyword" value="">
					<input type="submit" name="" value="去重複搜">
					<input type="hidden" name="search_type" value="2">
				</form>
				<form action="show_db" method="POST" name="" style= "display:inline">
					<input type="text" name="keyword" value="">
					<input type="submit" name="" value="來源搜尋">
					<input type="hidden" name="search_type" value="3">
				</form>
				<!-- <form action="get_employee_himself_customer" method="POST" name="" style= "display:inline">
					<input type="submit" name="" value="查看全部客戶">
					<input type="hidden" name="employee_name" value="<?php echo $_SESSION['user_name'] ?>">
				</form> -->
			</div>
		</div>
		

		
		<div style="clear:left;">
			
			<!-- 上傳按鈕 -->
			<div class="upload">
				<form class="form-horizontal well" action="<?php echo base_url(); ?>index.php/show_db_controller/import" method="post" name="upload_excel" enctype="multipart/form-data">
					<input type="file" name="file" id="file" class="input-large">
					<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading">上傳</button>
				</form>
			</div>
		</div>
		
		<br><br>

		<?php
		if (isset($keyword)) {
			echo '搜尋: <b>'.$keyword.'</b>';
		}

		if (isset($data)) {
			echo "<br>";
			echo "資料筆數: ". count($data)."<br>";
		}
		else {
			echo "<br>";
			echo "目前無資料";
		} ?>

		<!-- table -->
		<div>
			<?php 
			if ($_SESSION['user_level']==2) { ?>
			<table align="center" style="width: 150px">
				<tr>
					<td style="border: 0px">
						<form action="get_employee_himself_customer" method="POST" name="" style= "display:inline">
							<input type="submit" name="" value="查看全部客戶">
							<input type="hidden" name="employee_name" value="<?php echo $_SESSION['user_name'] ?>">
						</form>
					</td>								
					<td style="border: 0px">
						<form action="download_excel" method="POST">
							<input type="submit" name="action" value="下載EXCEL">
							<?php if (isset($keyword)) { ?>
								<input type="hidden" name="search_type" value="<?php echo $search_type; ?>">
								<input type="hidden" name="download_keyword" value="<?php echo $keyword; ?>">
							<?php } ?>
						</form>
					</td>
					<td style="border: 0px">
						<form action="assign" method="POST">
							<input type="submit" name="" value="分配客戶名單">
						</form>
					</td>
					<td style="border: 0px">
						
					</td>
				</tr>
			</table>
			<?php } ?>

			<table style="width:100%" border="1" >
				<tr>
					<th nowrap="nowrap">編號</th>
					<th nowrap="nowrap">姓名</th>
					<th nowrap="nowrap">日期</th>
					<th nowrap="nowrap">股票</th>
					<th nowrap="nowrap">LINE</th>
					<th nowrap="nowrap">電話</th>
					<th nowrap="nowrap">手機1</th>
					<th nowrap="nowrap">手機2</th>
					<th nowrap="nowrap">來源</th>
					<th nowrap="nowrap">認養人</th>
					<th nowrap="nowrap">更多</th>
				</tr>

				<?php 
				
				if (isset($data)) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						echo "<td>".$data[$i]['id']."</td>";
						echo "<td>".$data[$i]['customer_name']."</td>";
						echo "<td>".$data[$i]['日期']."</td>";
						echo '<td nowrap="nowrap">'.$data[$i]['company_name']."</td>";
						echo "<td>".$data[$i]['LINE']."</td>";
						echo '<td nowrap="nowrap">'.$data[$i]['電話']."</td>";
						echo "<td>".$data[$i]['手機1']."</td>";
						echo "<td>".$data[$i]['手機2']."</td>";
						echo "<td>".$data[$i]['來源']."</td>";
						echo "<td>".$data[$i]['認養人']."</td>";
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

</div>

</body>
</html>