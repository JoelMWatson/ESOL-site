<?php
require("php/function.php");
$page_title = "Instructor panel";
require_once("blocks/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = test_input($_POST['name']);
	$lastname = test_input($_POST['lastname']);
	$login = test_input($_POST['login']);
	$pass = test_input($_POST['pass']);
	$pass = md5($pass);
	
	$sql = mysql_query("UPDATE users SET name = '$name', lastname = '$lastname', login = '$login', password = '$pass' WHERE id = '$_SESSION[user_id]'");

	if ($sql) {
		$msg = "Data update successfully!";
	}
	else {
		$msg = "Error! {mysql_error()}";
	}
}
$sql = mysql_query("SELECT name, lastname, login FROM users WHERE id = '$_SESSION[user_id]'");
$row = mysql_fetch_array($sql);

$sql_count = mysql_query("SELECT * FROM users WHERE root_id = '2'");
$row_count = mysql_num_rows($sql_count);

require_once("blocks/content.php");
if (!$_SESSION['user_id']) {
	?>
	<div class="col-md-12">
		<div class="info">Oops... This page is for registered users. To view information please sign in or <a href="register.php">register!</a></div>
	</div>
	<?php
}
else {
	?>
	<h1>Instructor panel</h1>
	<div class="col-md-3">
		<h2>Profile menu</h2>
		<nav class="profile_mnu">
			<ul>
				<li><a href="students.php">VIEW STUDENTS LIST</a></li>
			</ul>
		</nav>
	</div>
	<div class="col-md-6">
		<p id="words_count">Found <?=$row_count;?> students in database </p>
	</div>
	<div class="col-md-3">
		<div class="right_sidebar">
			<h2>Edit your data</h2>
			<?php if($msg) echo "<div class='msg'>{$msg}</div>";?>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label for="name">First name:</label>
				<input type="text" id="name" name="name" value="<?=$row['name']?>">

				<label for="lastname">Last name:</label>
				<input type="text" id="lastname" name="lastname" value="<?=$row['lastname']?>">
				
				<label for="login">Login:</label>
				<input type="text" id="login" name="login" value="<?=$row['login']?>">
									
				<label for="pass">Password:</label>
				<input type="text" id="pass" name="pass" value="<?=$row['pass']?>">
				
				<div class="field">
					<input type="submit" name="submit" value="Save" class="button ico_save">
				</div>
			</form>
		</div>
	</div>
	<?php
}
require_once("blocks/footer.php");
?>