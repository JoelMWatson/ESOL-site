<?php require("function.php");

$msg = "";
$login = $pass = "";
session_start();
//setcookie('user_id', $id, time() - 3600);
if (!$_SESSION['user_id']) {
	if (isset($_POST['login'])) {
		$login = test_input($_POST['login']);
		$pass = test_input($_POST['pass']);
		$pass = md5($pass);
		$sql = mysql_query("SELECT id, login, password, root_id FROM users WHERE login = '$login' and password = '$pass'");
		$row = mysql_fetch_array($sql);

		if (mysql_num_rows($sql) == 1) {
			$user_id = $row['id'];
			$_SESSION['user_id'] = $user_id;
			$_SESSION['username'] = $login;
		//setcookie('user_id', $user_id, time() + 300);
			if ($row[root_id] == 2) {
				$msg = "Login successfully!";
				header("Location: ../user_profile.php?msg=$msg");
				exit();
			}
			else {
				$msg = "Login successfully!";
				header("Location: ../admin.php?msg=$msg");
				exit();
			}	
		}
		else {
			$msg = "The login or password is wrong!";
			header("Location: /?msg=$msg");
		}	
	}
	else {
		$msg = "Please sign in!";
		header("Location: /?msg=$msg");
	}
}
?>