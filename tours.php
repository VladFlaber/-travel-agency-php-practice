<div class="container">
	
		<select name="countryId" id="sCountry" onchange="countrySelected(this.value)">
			<option value="0">SelectCountry</option>
			<?php
			$countries=getCountries();
			 while ($row=mysqli_fetch_array($countries)) {
			 	 
			 	echo "<option value='".$row[0]."'>".$row[1]."</option>";
			 }
			?>
		</select>
		 
		<div id="cit"></div>
		<div id="Hotels"></div>
</div>