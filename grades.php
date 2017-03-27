<?php
require("php/function.php");
$page_title = "Administration panel";
require_once("blocks/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = test_input($_POST['name']);
	$lastname = test_input($_POST['lastname']);
	$login = test_input($_POST['login']);
	$pass = test_input($_POST['pass']);
	$pass = md5($pass);
	
	$sql = mysql_query("UPDATE users SET name = '$name', lastname = '$lastname', login = '$login', password = '$pass' WHERE id = '$_SESSION[user_id]'");

	if ($sql) {
		$msg = "Data update successfully!";
	}
	else {
		$msg = "Error! {mysql_error()}";
	}
}
$sql = mysql_query("SELECT name, lastname, login FROM users WHERE id = '$_SESSION[user_id]'");
$row = mysql_fetch_array($sql);

$sql_count = mysql_query("SELECT * FROM users WHERE root_id = '2'");
$row_count = mysql_num_rows($sql_count);

require_once("blocks/content.php");
if (!$_SESSION['user_id']) {
	?>
	
	<div class="col-md-12">
		<div class="info">Oops... This page is for registered users. To view information please sign in or <a href="register.php">register!</a></div>
	</div>
	<?php
}
else {
	?>
	<body  onLoad="window.scrollBy(0,330)">
	<h1>Instructor panel</h1>
	<?php
	//Read from database           
	$sql = mysql_query("SELECT users.id, users.name, users.lastname, card.id AS id_card, card.voc_word, card.chapter,
					card.time_created, card.turned 
			FROM users
			INNER JOIN card
			ON card.id_user = users.id;
			");
	$row = mysql_fetch_array($sql);
	?>
	<div class="col-md-6" id="summary_table">
			<div class="view_wrapp">
				<table id="myTable" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Student</th>
							<th>Vocabulary Word</th>
							<th>Chapter</th>
							<th>Submition Time</th>
							<th>Graded</th>
						</tr>
					</thead>
					<tbody>
			<?php
			while ($row = mysql_fetch_array($sql))
			{
						if ($row['turned'] != null)
						{
									$graded = "Yes";
						} else
						{
									$graded = "No";
						}
						echo "<tr><td>".$row['name'].' '.$row['lastname']."</td><td><a href='view.php?id={$row[id]}&card={$row[id_card]}'>".$row['voc_word']."</a></td><td>"
						.$row['chapter']."</td><td>".$row['time_created']."</td><td>".$graded."</td></tr>";
			}?>
					
					
					</tbody>
			</table>
		</div>
	</div>
	</body>
	
<?php
}
require_once("blocks/footer.php");
?>
<script>
	$(document).ready(function(){
    $('#myTable').DataTable();
	});
	</script>