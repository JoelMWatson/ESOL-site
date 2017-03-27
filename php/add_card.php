<?php
session_start();
require_once("function.php");
if ($_REQUEST['submit']) {
	
	$chapter = test_input($_REQUEST['chapter']);
	$word = test_input($_REQUEST['word']);
	$part_of_speech = test_input($_REQUEST['part_of_speech']);
	$word_use = test_input($_REQUEST['word_use']);
	$definition = test_input($_REQUEST['definition']);
	$example = test_input($_REQUEST['example']);

	$sql = mysql_query("INSERT INTO card (chapter, voc_word, part_of_speech, word_in_use, definition, example, id_user, time_created)
		VALUE ('$chapter', '$word', '$part_of_speech', '$word_use', '$definition', '$example', '$_SESSION[user_id]', NOW())");

	$sqlMax = mysql_query("SELECT MAX(id) AS id FROM card");
	$row = mysql_fetch_array($sqlMax);
	$card_id = $row['id'];

	$sqlChap = mysql_query("SELECT chapter FROM card WHERE id = '$card_id'");
	$rowChap = mysql_fetch_array($sqlChap);
	$chapter = $rowChap['chapter'];

	if ($sql) {
		header("Location: ../review.php?id={$card_id}&chapter={$chapter}");
	}
	else {
		$msgErr = "Error! Din't add new card!";
	}
}
?>