<?php session_start(); 
require_once("php/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$page_title;?> | Green River ESOL Program | Green River College</title>
	<link rel="stylesheet" href="css/bootstrap-grid-3.3.1.min.css">
	<link rel="stylesheet" href="libs/font-awesome-4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<div class="wrapper">
		<header>
			<div class="top_line">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="logo_wrap">
								<a href="/">Green River ESOL Program</a>
							</div>
						</div>
						<div class="col-md-8">			
							<nav class="top_mnu">
								<ul>
									<li><a href="/">Home</a></li>
									<?php
									if(isset($_SESSION['user_id'])) {
										$sql = mysql_query("SELECT id, root_id FROM users WHERE id = '$_SESSION[user_id]'");
										$row = mysql_fetch_array($sql);
										
										if ($row['root_id'] == '2') {
											?>
											<li><a href="new_card.php">Create card</a></li>
											<li><a href="review.php">Review cards</a></li>
											<?php
										}
										else {
											?>
											<li><a href="students.php">Students list</a></li>
											<?php
										}
									} ?>
									<li><a href="link.php">External links</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Learn English in words!</h1>
					</div>
				</div>
			</div>
			<div class="login_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-11">
							<div class="login_form">
								<form action="php/authorize.php" method="post">
									<?php 
									if(!empty($msg))
										echo "<div class='msg'> {$msg} </div>";
									if(!$_SESSION['user_id']) {
										?>
										<div class="field">
											<label for="login"><b>Login:</b></label>
											<input type="text" id="login" name="login">
										</div>
										<div class="field">
											<label for="pass"><b>Password:</b></label>
											<input type="password" id="pass" name="pass">
										</div>
										<div class="field">
											<span><b>Not registered? </b><a href="register.php"><b>Register</b></a></span>
											<input type="submit" name="submit" class="button login" value="Login">
										</div>
										<?php
									}
									else {
										?>
										<h3>Welcome <?=$_SESSION['username'];?>!</h3>
										<nav class="login_mnu">
											<ul>
												<li><a href="<?php if (root($_SESSION['user_id']) == '2') { echo "user_profile.php";} else { echo "admin.php";} ?>" class="button_b">&nbspPROFILE&nbsp</a></li>
												<li>&nbsp</li>
												<li><a href="php/exit.php" class="button_b">SIGN OUT</a></li>
											</ul>
										</nav>
										<?php
									}
									?>
								</form>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
			<div class="line">
				<div class="container">
					<div class="row">
					</div>
				</div>
			</div>
		</header>