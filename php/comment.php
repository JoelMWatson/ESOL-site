<?php
$sql = mysql_query("SELECT * FROM comments WHERE id_card = '$id'");
$row = mysql_fetch_array($sql);

if ($row['comment']) {
	do {
		echo $row['comment'];
	} while ($row = mysql_fetch_array($sql));
}
?>