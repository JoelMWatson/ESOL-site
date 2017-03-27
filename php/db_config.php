<?php
define("DB_HOST", "localhost");
define("DB_USER", "oleksand_user");
define("DB_PASS", "user1111");
define("DB_NAME", "oleksand_esol");

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS);

if(!$conn) {
	die("Connection failed: " . mysql_error());
}

$db = mysql_select_db(DB_NAME);
?>