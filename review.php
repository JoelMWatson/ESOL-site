<?php
$page_title = "Review card";
$id = $_GET['id'];
require_once("blocks/header.php");
require_once("blocks/content.php");

if (!$_SESSION['user_id']) {
	?>
	<div class="col-md-12">
		<div class="info">Oops...This page is for registered users. To view information please sign in or<a href="register.php">register!</a></div>
	</div>
	<?php
}
else {
	$chapter = $_REQUEST['chapter'];

	$sql = mysql_query("SELECT * FROM card WHERE id_user = '$_SESSION[user_id]' AND chapter = '$chapter'");
	$row = mysql_fetch_array($sql);

	$sqlCom = mysql_query("SELECT * FROM comments WHERE id_card = '$id'");
	$rowCom = mysql_fetch_array($sqlCom);

	?>
	<h1>Review Cards</h1>
	<div class="col-md-3">
		<div class="chapter">
			<h2>Chapter</h2>
			<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
				<select name="chapter" id="chapter" onchange="this.form.submit()">
					<option value="0">Сhoose a chapter</option>
					<option value="Chapter 1"  <?php if ('Chapter 1' == $row['chapter']) echo "selected";?>>Chapter 1</option>
					<option value="Chapter 2"  <?php if ('Chapter 2' == $row['chapter']) echo "selected";?>>Chapter 2</option>
					<option value="Chapter 3"  <?php if ('Chapter 3' == $row['chapter']) echo "selected";?>>Chapter 3</option>
					<option value="Chapter 4"  <?php if ('Chapter 4' == $row['chapter']) echo "selected";?>>Chapter 4</option>
					<option value="Chapter 5"  <?php if ('Chapter 5' == $row['chapter']) echo "selected";?>>Chapter 5</option>
					<option value="Chapter 6"  <?php if ('Chapter 6' == $row['chapter']) echo "selected";?>>Chapter 6</option>
					<option value="Chapter 7"  <?php if ('Chapter 7' == $row['chapter']) echo "selected";?>>Chapter 7</option>
					<option value="Chapter 8"  <?php if ('Chapter 8' == $row['chapter']) echo "selected";?>>Chapter 8</option>
					<option value="Chapter 9"  <?php if ('Chapter 9' == $row['chapter']) echo "selected";?>>Chapter 9</option>
					<option value="Chapter 10" <?php if ('Chapter 10' == $row['chapter']) echo "selected";?>>Chapter 10</option>
					<option value="Chapter 11" <?php if ('Chapter 11' == $row['chapter']) echo "selected";?>>Chapter 11</option>
					<option value="Chapter 12" <?php if ('Chapter 12' == $row['chapter']) echo "selected";?>>Chapter 12</option>
				</select>
			</form>
			<?php
			if ($chapter == $row['chapter'] && $chapter != "") {
				echo "<ul>";
				do {					
					echo "<li><b><a href='review.php?id={$row[id]}&chapter={$row[chapter]}'>{$row[voc_word]}</a> <br>
					- <a href='edit_card.php?id={$row[id]}&chapter={$row[chapter]}'>edit card</a></b>
					</li>";										
				} 
				while ($row = mysql_fetch_array($sql));
				echo "</ul>";

			}
			else{
				echo "<p></p>";
				echo "<p><b>This chapter is empty!</b></p>";
			}
			?>
		</div>
	</div>
	<div class="col-md-6">
		<?php

		if (!$_REQUEST['submit'] && !$id) {
			echo "<p class='info'><b>Please, choose a chapter and click the word to view  a card!</b></p>";
		}
		else {
			if ($_GET['chapter'] == $chapter) {
				$sql = mysql_query("SELECT card.*, users.* FROM card, users WHERE card.id_user = '$_SESSION[user_id]' AND card.chapter = '$_GET[chapter]' AND card.id = '$id' AND users.id = '$_SESSION[user_id]'");
				$row = mysql_fetch_array($sql);
				?>
				<div class="view_card">
					<div id="card">
						<div class="front">
							<h3>Front of card:</h3>
							<div class="field_r">
								<p><b>Name:</b> <?=$row['name']." ".$row['lastname'];?></p>
							</div>
							<div class="field_r">
								<p><b>Chapter:</b> <?=$row['chapter'];?></p>
							</div>
							<div class="field_r">
								<p><b>Vocabulary word</b>: <?=$row['voc_word'];?></p>
							</div>
							<div class="field_r">
								<p><b>Part of Speech:</b> <?=$row['part_of_speech'];?></p>
							</div>
							<div class="field_r">
								<p><b>Word in use:</b> <?=$row['word_in_use'];?></p>
							</div>							
						</div>
						<div class="back">
							<h3>Back of card:</h3>
							<p><b>Definition:</b> <?=$row['definition'];?></p>
							<p><b>My example sentence:</b> <?=$row['example'];?></p>
						</div>
						<div class="click">
							<p><b>Click on card to flip it!</b></p>
						</div>
					</div>
				</div>
				<?php } else {
					echo "<p class='info'>Empty chapter!</p>";
				}
			}?>
		</div>
		<div class="col-md-3">
			<div class="feedback">
				<?php if ($id) { ?>
				<h2>Instructor's feedback</h2>
				<p><b>Overall grade:</b> <?=$row['points']?></p>
				<p><b>Turned in:</b> <?=$row['turned']?></p>
				<p><b>Comments:</b></p>
				<?php
				if ($rowCom['comment']) {
					echo "<div class='comment'>";
					do {
						echo $rowCom['comment'];
					} while ($rowCom = mysql_fetch_array($sqlCom));
					echo "</div>";
				}
				?>
			</div>
		</div>
		<?php }
	}

	require_once("blocks/footer.php");?>
	<script>$("#card").flip();</script>