<?php
require("php/function.php");
$msg = "";
$id = test_input($_GET['id']);

if ($id) {
	$sql = mysql_query("DELETE FROM users WHERE id = '$id'");

	if ($sql) {
		$msg = "Student deleted successfully!";
		header("Location: students.php?msgd=$msg");
	}
	else {
		$msg = "Error deleting student: " . mysql_error();
		header("Location: students.php?msgd=$msg");
	}
}

?>