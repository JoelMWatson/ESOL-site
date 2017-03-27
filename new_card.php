<?php
$page_title = "Create card";
require_once("blocks/header.php");?>
<?php require_once("blocks/content.php");

if (!$_SESSION['user_id']) {
	?>
	<div class="col-md-12">
		<div class="info">Oops... This page is for registered. To view information log or go through <a href="register.php">registration!</a></div>
	</div>
	<?php
}
else {
	$sql = mysql_query("SELECT name, lastname FROM users WHERE id = '$_SESSION[user_id]'");
	$row = mysql_fetch_array($sql);
	?>
	<body  onLoad="window.scrollBy(0,330)">
	<div class="col-md-12" >
		<h1>Vocabulary Word Cards</h1>
		<div class="card">
			<?php if($msgErr) echo $msgErr;?>
			<form action="php/add_card.php" method="post">
				<div class="field">
					<label for="name"><b>Your name:</b></label>
					<input type="text" name="name" id="name" placeholder="Enter your name" required value="<?=$row['name']." ".$row['lastname'];?>">
				</div>
				<div class="field">
					<label for="chapter"><b>Chapter:</b></label>
					<select name="chapter" id="chapter" required>
						<option value="0">Сhoose a chapter</option>
						<option value="Chapter 1">Chapter 1</option>
						<option value="Chapter 2">Chapter 2</option>
						<option value="Chapter 3">Chapter 3</option>
						<option value="Chapter 4">Chapter 4</option>
						<option value="Chapter 5">Chapter 5</option>
						<option value="Chapter 6">Chapter 6</option>
						<option value="Chapter 7">Chapter 7</option>
						<option value="Chapter 8">Chapter 8</option>
						<option value="Chapter 9">Chapter 9</option>
						<option value="Chapter 10">Chapter 10</option>
						<option value="Chapter 11">Chapter 11</option>
						<option value="Chapter 12">Chapter 12</option>
					</select>
				</div>
				<div class="field">
					<label for="word"><b>Vocabulary word:</b></label>
					<input type="text" name="word" id="word" placeholder="Enter a word you want to use" required>
				</div>
				<div class="field">

					<label for="part_of_speech"><b>Part of speech:</b></label>
					<select name="part_of_speech" id="part_of_speech" required>
						<option value="0">Сhoose part of speech</option>
						<option value="Noun"><b>Noun</b></option>
						<option value="Verb"><b>Verb</b></option>
						<option value="Adjective"><b>Adjective</b></option>
						<option value="Adverb"><b>Adverb</b></option>
						<option value="Pronoun"><b>Pronoun</b></option>
						<option value="Conjunction"><b>Conjunction</b></option>
						<option value="Preposition"><b>Preposition</b></option>
					</select>				
				</div>
				<div class="field">
					<label for="word_use"><b>Word in use:</b></label>
					<textarea name="word_use" id="word_use" placeholder="Copy one sentence from the book with this word" required></textarea>
				</div>
				<div class="field">
					<label for="definition"><b>Definition:</b></label>
					<textarea name="definition" id="definition" placeholder="In your own words describe the word" required></textarea>
				</div>
				<div class="field">
					<label for="example"><b>My example sentence:</b></label>
					<textarea name="example" id="example" placeholder="Create your own example sentence" required></textarea>
				</div>
				<input type="submit" name="submit" value="Add word" class="button ico_create">
			</form>
		</div>
	</div>
	</body>
	<?php 
}
require_once("blocks/footer.php");
?>