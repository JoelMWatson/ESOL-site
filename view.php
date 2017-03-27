<?php
require_once("php/check.php");
$page_title = "View students cards";
require_once("blocks/header.php");
require("php/db_config.php");
$id = $_GET['id'];
$card = $_GET['card'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$comment = test_input($_POST["comment"]);
	$points = test_input($_POST["points"]);
	$turned = test_input($_POST["turned"]);
	$avtor = test_input($_SESSION['username']);
	$time = date('Y-m-d H:i:s');
	
	$sql = mysql_query("UPDATE oleksand_esol.card SET points='$points', turned='$turned' WHERE id = $card");
	
	if ($comment !== "") {
		$sql2 = mysql_query("INSERT INTO comments (comment, avtor, id_card, time) VALUE('$comment', '$avtor', '$card', '$time')");
	}
	
	if (!$sql) {
		$msg = "Error!" . mysql_error($conn);
	}
}

require_once("blocks/content.php");

if ($card && $card != "") {

	$sql2 = mysql_query("SELECT card.*, users.* FROM card, users WHERE card.id_user = '$id' AND card.id = '$card' AND users.id = '$id'");
	$row = mysql_fetch_array($sql2);
	
	$sqlWord = mysql_query("SELECT * FROM card WHERE id_user = '$id'");
	$rowWord = mysql_fetch_array($sqlWord);

	$sqlCom = mysql_query("SELECT * FROM comments WHERE id_card = '$card'");
	$rowCom = mysql_fetch_array($sqlCom);

	?>
	<body  onLoad="window.scrollBy(0,330)">
	<h1>Student - <?=$row['name']. " ".$row['lastname'];?></h1>
	<h2 style="text-decoration: underline;"><?="current card - ".$row['voc_word'];?></h2>
	<div class="col-md-3">
		<h2>Word</h2>
		<?php
		echo "<ul>";
		do {
			echo "<li><a href='view.php?id={$id}&card={$rowWord[id]}'>{$rowWord['voc_word']}</a></li>";
		}
		while ($rowWord = mysql_fetch_array($sqlWord));
		echo "</ul>";
		?>
	</div>
	<div class="col-md-6">
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
	</div>
	<div class="col-md-3">
		<div class="feedback">
			<?php if ($id) { 
				if (!empty($msg)) {
					echo $msg; 
				}

				?>
				<h2>Instructor's feedback</h2>
				<form action="<?=$_SERVER['PHP_SELF'];?>?id=<?=$id;?>&card=<?=$card;?>" method="post">
					<div class="field">
						<label for="points">Overall grade:</label>
						<input type="number" min="0" max="3" step="0.5" name="points" id="points" value="<?=$row['points']?>" style="width: 40px; text-align: center;">
					</div>
					
					<div class="field">
						<label for="turned">Card turned in:</label>						
						<select name="turned" id="turned"> 
							<!--<option value="mark_as" <?php if (($row['turned'] != "On-Time") || ($row['turned'] != "Late")) echo "selected";?>>None</option>-->
							<option selected disabled>Mark as:</option>
							<option value="On-Time" <?php if ($row['turned'] == "On-Time") echo "selected";?>>On-Time</option>
							<option value="Late" <?php if ($row['turned'] == "Late") echo "selected";?>>Late</option>
						</select>
						<p><?php echo $row['time_created'] ?></p>
					</div>
					<div class="field">
						<label for="comment">Comments:</label>
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
					<div class="field">
						<textarea name="comment" id="comment" placeholder="Enter your feedback."></textarea>
					</div>
					<div class="field">
						<input type="submit" name="submit" value="Grade" class="button ico_add">
					</div>
				</form>
			</div>
		</div>
		<?php } else {
			echo "<p class='info'>Empty chapter!</p>";
		}
	}
	else {
		$sql = mysql_query("SELECT * FROM card WHERE id_user = '$id'");
		$row = mysql_fetch_array($sql);
		$sqlUs = mysql_query("SELECT * FROM users WHERE id = '$id'");
		$rowUs = mysql_fetch_array($sqlUs);
		?>
		<div class="col-md-12">
			<h1>Student - <?=$rowUs['name']." ".$rowUs['lastname'];?></h1>
			<?php
			if (!empty($row['voc_word'])) {
				echo "<ul>";
				do {
					echo "<li><a href='view.php?id={$id}&card={$row[id]}'>{$row['voc_word']}</a></li>";
				}
				while ($row = mysql_fetch_array($sql));
				echo "</ul>";
			}
			else {
				echo "<p id='words_count'>This student has not created any cards yet!</p>";
			}
			?>
		</div>
	</body>
		<?php
	}
	require_once("blocks/footer.php");
	?>
	<script>$("#card").flip();</script>