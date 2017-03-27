<?php
require_once("db_config.php");

function test_input($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function root($data) {
	$sql = mysql_query("SELECT root_id FROM users WHERE id = '$data'");
	$result = mysql_fetch_array($sql);
	$data = $result['root_id'];
	return $data;
}

function active() {
	if ($id == $row['id']) $active = "class='active'";
	return $active;
}
?>