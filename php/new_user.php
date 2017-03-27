<?php
require("function.php");
$msg = "";
$n_login = $n_pass = $name = $lastname = "";
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$n_login = test_input($_POST['n_login']);
	$n_pass = test_input($_POST['n_pass']);
	$name = test_input($_POST['name']);
	$lastname = test_input($_POST['lastname']);
	
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$privatkey = "6LcwyRATAAAAAMOeUfA-QlZtcTz7yZyCZV1k4lVN";
	$response = file_get_contents($url."?secret=".$privatkey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
	$data = json_decode($response);

	if (isset($data->success) AND $data->success == true) {
		if(!empty($n_login) && !empty($n_pass)) {
			$n_pass = md5($n_pass);
			
			$sql = mysql_query("INSERT INTO users (name, lastname, login, password) VALUES ('$name', '$lastname', '$n_login', '$n_pass')");
			$msg = "Registered successfully!";

			if ($sql) {
				$sqlMax = mysql_query("SELECT MAX(id) AS id FROM users");
				$rowMax = mysql_fetch_array($sqlMax);
				$id = $rowMax['id'];
				
				$sql_l = mysql_query("SELECT id, login, password FROM users WHERE id = '$id'");
				$row_l = mysql_fetch_array($sql_l);
				
				$user_id = $row_l['id'];
				$_SESSION['user_id'] = $user_id;
				$_SESSION['username'] = $row_l['login'];
				
				header("Location: ../user_profile.php");
				exit();
			}
			
		}
		else {
			$msg = "Error!";
			header("Location: ../register.php?msgr=$msg");
		}
	} else {
		$_SESSION['name'] = $name;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['login'] = $n_login;
		$msg = "Wrong captcha!";
		header("Location: ../register.php?msgr=$msg");
	}
	session_unset();
}
?>