<?php
$page_title = "Edit card";
require_once("blocks/header.php");
require_once("blocks/content.php");
$id_get = $_GET['id'];
if (!$_SESSION['user_id']) {
	?>
	<div class="col-md-12">
		<div class="info">Oops... This page is for registered. To view information log or go through <a href="register.php">registration!</a></div>
	</div>
	<?php
}
else {
	if ($_GET['id']) {
		$id = test_input($_GET['id']);

		if ($_POST['submit']) {
			$chapter = test_input($_REQUEST['chapter']);
			$word = test_input($_REQUEST['word']);
			$part_of_speech = test_input($_REQUEST['part_of_speech']);
			$word_use = test_input($_REQUEST['word_use']);
			$definition = test_input($_REQUEST['definition']);
			$example = test_input($_REQUEST['example']);

			$sql = mysql_query("UPDATE card SET chapter = '$chapter', voc_word = '$word', part_of_speech = '$part_of_speech', word_in_use = '$word_use', definition = '$definition', example = '$example' WHERE id = '$id'");
			if ($sql) {
				$msg = "Changes saved!";
			}
		}
		
		$sql = mysql_query("SELECT card.*, users.* FROM card, users WHERE card.id = '$id' AND users.id = '$_SESSION[user_id]'");
		$row = mysql_fetch_array($sql);
		?>
		<div class="col-md-12">
			<h1>Vocabulary Word Cards</h1>
			<div class="card">
				<?php if(!empty($msg))
				echo "<div class='msg'> {$msg} </div>"; ?>
				<form action="<?=$_SERVER['PHP_SELF']?>?id=<?=$id;?>" method="post">
					<div class="field">
						<label for="name">Your name:</label>
						<input type="text" name="name" id="name" placeholder="Enter your name" required value="<?=$row['name']." ".$row['lastname'];?>">
					</div>
					<div class="field">
						<label for="chapter">Chapter:</label>
						<select name="chapter" id="chapter" required>
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
					</div>
					<div class="field">
						<label for="word">Vocabulary word:</label>
						<input type="text" name="word" id="word" placeholder="Enter a word you want to use" value="<?=$row['voc_word'];?>" required>
					</div>
					<div class="field">
						<label for="part_of_speech">Part of speech:</label>
						<select name="part_of_speech" id="part_of_speech" required>
							<option value="0">Сhoose part of speech</option>
							<option value="Noun" <?php if ('Noun' == $row['part_of_speech']) echo "selected";?>>Noun</option>
							<option value="Verb" <?php if ('Verb' == $row['part_of_speech']) echo "selected";?>>Verb</option>
							<option value="Adjective" <?php if ('Adjective' == $row['part_of_speech']) echo "selected";?>>Adjective</option>
							<option value="Adverb" <?php if ('Adverb' == $row['part_of_speech']) echo "selected";?>>Adverb</option>
							<option value="Pronoun" <?php if ('Pronoun' == $row['part_of_speech']) echo "selected";?>>Pronoun</option>
							<option value="Conjunction" <?php if ('Conjunction' == $row['part_of_speech']) echo "selected";?>>Conjunction</option>
							<option value="Preposition" <?php if ('Preposition' == $row['part_of_speech']) echo "selected";?>>Preposition</option>
						</select>				
					</div>
					<div class="field">
						<label for="word_use">Word in use:</label>
						<textarea name="word_use" id="word_use" placeholder="Copy one sentence from the book with this word" required><?=$row['word_in_use'];?></textarea>
					</div>
					<div class="field">
						<label for="definition">Definition:</label>
						<textarea name="definition" id="definition" placeholder="In your own words describe the word" required><?=$row['definition'];?></textarea>
					</div>
					<div class="field">
						<label for="example">My example sentence:</label>
						<textarea name="example" id="example" placeholder="Create your own example sentence" required><?=$row['example'];?></textarea>
					</div>
					<input type="submit" name="submit" value="Save" class="button ico_save">
					<input type="button" name="back" value="Go back" class="button ico_back" onclick="history.back();">
				</form>
			</div>
		</div>
		<?php
	}
}
require_once("blocks/footer.php");
?>