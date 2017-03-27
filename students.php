<?php
$page_title = "View list of students";
require_once("blocks/header.php");
$sort = test_input($_GET['sort']);
if ($sort) {
	if ($sort == "lastname") {
		$sql = mysql_query("SELECT * FROM users WHERE root_id = '2' ORDER BY lastname");
		$row = mysql_fetch_array($sql);
	}
	elseif ($sort == "name") {
		$sql = mysql_query("SELECT * FROM users WHERE root_id = '2' ORDER BY name");
		$row = mysql_fetch_array($sql);
	}
	elseif ($sort == "chapter") {
		$sql = mysql_query("SELECT card.*, users.* FROM card, users WHERE users.root_id = '2' ORDER BY card.chapter");
		$row = mysql_fetch_array($sql);
	}
}
else {
	$sql = mysql_query("SELECT * FROM users WHERE root_id = '2'");
	$row = mysql_fetch_array($sql);
}
if ($_GET['del']) {
	$sql = mysql_query("DELETE users, card FROM users, card WHERE users.id > '1'");
}
require_once("blocks/content.php");
?>
<body  onLoad="window.scrollBy(0,330)">
<div class="col-md-12">
	<h1>View list of students</h1>
	<div class="view_wrapp">
		<?php if ($_GET['msgd']) {echo "<div class='msg'>{$_GET[msgd]}</div>";}
		if ($rows = mysql_num_rows($sql) > 1){
		?>
		<table>
			<tr>
				<th><a href="<?php if($sort == "lastname") {echo "?sort=name";} elseif ($sort == "name") {echo "?sort=lastname";} else {echo "?sort=lastname";}?>">Student</a></th>
				<th>View cards</th>
				<th>Delete</th>
			</tr>
			<?php
			while ($row = mysql_fetch_array($sql)) {
				?>
				<tr>
					<td><?php if ($sort == "name") {echo $row['name']. " ".$row['lastname'];} else {echo $row['lastname'] . " " . $row['name'];}?></td>
					<td><a href="view.php?id=<?=$row['id'];?>">View</a></td>
					<td><a href="deluser.php?id=<?=$row[id];?>" onclick="return confirm('Are you sure want to delete this student?')" class="ico_delete"></a></td>
				</tr>
				<?php
			}
			?>
		</table>
		<p><a href="<?=$_SERVER['PHP_SELF'];?>?del=delall" onclick="return confirm('Are you sure you want to delete all the data?')" >Delete all students!</a>  <a href="grades.php" target="blank" style=float:right>Summary table</a></a></p>
		<?php
			}
			else {
				echo "<p class='center'>No data!</p>";
			}
		?>
	</div>
</div>
</body>
<?php
require_once("blocks/footer.php");
?>