<table class='table'>
<thead>
	<th>Id</th>
	<th>Location</th>
	<th>Hotel</th>
	<th>Rating</th>
	<th>Cost</th>
	<th>Info</th>
</thead>
<tbody>
<?php 
include_once("functions.php");
		$cId=$_POST['Id'];
		$hotels=getHotelsByCityId($cId);
		var_dump($hotels);
		while ($rows=mysqli_fetch_array($hotels)) {
			echo "<tr>";
			echo "<td>".$rows[0]."</td>";
			echo "<td>".$rows[1]."</td>";
			echo "<td>".$rows[2]."</td>";
			echo "<td>".$rows[3]."</td>";
			echo "<td>".$rows[4]."</td>";
			echo "<td><a target='_blank' href='info.php?id=".$rows[0]."''>learn more</a></td>";
			echo "</tr>";
		}
 ?>
</tbody>
</table>
