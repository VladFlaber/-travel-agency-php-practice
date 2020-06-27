<?php 
if (!isset($_SESSION['admin']))
{
echo "<h3/><span style='color:red;'>For Administrators Only!
</span><h3/>";
exit();
}
$res=getUsers();

?>

	<?php
	 if(!isset($_POST['add'])){ ?>
	<form method="POST" enctype='multipart/form-data'>
	<select name="users" >
	<option value="0" >select user</option>
	<?php 
	while ($row=mysqli_fetch_array($res)) {
	  echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	?>
	<select>
		<input type="file" name="upload">
		<input type="submit" name='add' value="add">
	</form>
<?php 
	} 
	else
	{
		$link=connect();
	$fn=$_FILES['upload']['tmp_name'];
	$file=fopen($fn,'rb');
	$img=fread($file, filesize($fn));
	fclose($file);
	$img=mysqli_real_escape_string($link,$img);
	$upd='update users set avatar="'.$img.'", role=1 where id='.$_POST['users'];
	
	mysqli_query($link, $upd);
	}

 ?>
<table class="table">
	<thead>
		<th>Id</th>
		<th>Login</th>
		<th>Email</th>
		<th>Role</th>

		<th>Avatar</th>
	</thead>
	<tbody>
	<?php 
$res=getUsers();

		while ($row=mysqli_fetch_array($res)) {
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			//echo "<td>".$row[6]."</td>";
			$img=base64_encode($row[6]);
			echo '<td><img height="100px"
			src="data:image/jpeg; base64,'.$img.'"/></td>';

			echo "</tr>";
		}
	 ?>
</tbody>
</table>