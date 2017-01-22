<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>


<html>
	<?php
	if (isset($this->session->userdata['logged_in'])) {

	header("location: http://localhost/login/index.php/user_authentication/user_login_process");
	}
	?>
	<head>
		<title>Login Form</title>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>

	<style>
		#main{
		width:960px;
		margin:50px auto;
		font-family:raleway;
		}

		span{
		color:red;
		}

		h2{
		background-color: #FEFFED;
		text-align:center;
		border-radius: 10px 10px 0 0;
		margin: -10px -40px;
		padding: 30px;
		}

		#login{

		width:300px;
		float: left;
		border-radius: 10px;
		font-family:raleway;
		border: 2px solid #ccc;
		padding: 10px 40px 25px;
		margin-top: 70px;
		}

		input[type=text],input[type=password], input[type=email]{
		width:99.5%;
		padding: 10px;
		margin-top: 8px;
		border: 1px solid #ccc;
		padding-left: 5px;
		font-size: 16px;
		font-family:raleway;
		}

		input[type=submit]{
		width: 100%;
		background-color:#FFBC00;
		color: white;
		border: 2px solid #FFCB00;
		padding: 10px;
		font-size:20px;
		cursor:pointer;
		border-radius: 5px;
		margin-bottom: 15px;
		}

		#profile{
		padding:50px;
		border:1px dashed grey;
		font-size:20px;
		background-color:#DCE6F7;
		}

		#logout{
		float:right;
		padding:5px;
		border:dashed 1px gray;
		margin-top: -168px;
		}

		a{
		text-decoration:none;
		color: cornflowerblue;
		}

		i{
		color: cornflowerblue;
		}

		.error_msg{
		color:red;
		font-size: 16px;
		}

		.message{
		position: absolute;
		font-weight: bold;
		font-size: 28px;
		color: #6495ED;
		left: 262px;
		width: 500px;
		text-align: center;
		}
	</style>

	<body>
		<?php
		if (isset($error_message)) {
			echo "<div class='message'>";
			echo $error_message;
			echo "</div>";
		}
		?>
		<?php
		if (isset($message_display)) {
			echo "<div class='message'>";
			echo $message_display;
			echo "</div>";
		}
		?>
		<div id="main">
			<div id="login">
				<h2>登入</h2>
				<hr/>
				<form action="login_check" method="post" accept-charset="utf-8">
					<label>帳號 :</label>
					<input type="text" name="acct" id="name" placeholder="username"/><br /><br />
					<label>密碼 :</label>
					<input type="password" name="pswd" id="password" placeholder="**********"/><br/><br />
					<input type="submit" value=" Login " name="submit"/><br />
				</form>
				
			</div>
		</div>
	</body>
</html>