	<?php 
	echo "<script> alert(hyi)</script>";?>
<select name="CityId" id='sCity' onchange="citySelected(this.value)" >
	<option value="0">Select city</option>
	<?php 

	include("functions.php");
		$cities=getCitiesByCountryId($_GET['Id']);
		while ($row=mysqli_fetch_array($cities)) 
		{
			echo "<option value='".$row[0]."'>".$row[1]."</option>";	
		}
	?>
</select>
