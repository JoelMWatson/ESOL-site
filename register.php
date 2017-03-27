<?php 
$page_title = "Registration";
require_once("blocks/header.php");
?>
<?php require_once("blocks/content.php");?>
<body  onLoad="window.scrollBy(0,330)">
<div class="col-md-12">
	<h1>New student</h1>
	<div class="reg_form">
		<?php 
		if(!empty($_GET['msgr']))
			echo "<div class='msg'>" . $_GET['msgr'] . "</div>";
		?>
		<form action="php/new_user.php" method="post">
			<div class="field">
				<label for="name">First name:</label>
				<input type="text" id="name" name="name" value="<?=$_SESSION['name'];?>" required>
			</div>
			<div class="field">
				<label for="lastname">Last name:</label>
				<input type="text" id="lastname" name="lastname" value="<?=$_SESSION['lastname'];?>" required>
			</div>
			<div class="field">
				<label for="n_login">Username:</label>
				<input type="text" id="n_login" name="n_login" value="<?=$_SESSION['login'];?>" required>
			</div>
			<div class="field">
				<label for="n_pass">Password:</label>
				<input type="password" id="n_pass" name="n_pass" required>
			</div>
			<div class="g-recaptcha" data-sitekey="6LcwyRATAAAAAIq23uvTgtn0GejNchd8QT-0es33"></div>
			<div class="field">
				<input type="submit" name="reg" class="button ico_add" value="Register">
			</div>
		</form>
	</div>
</div>
</body>
<?php
require_once("blocks/footer.php");?>