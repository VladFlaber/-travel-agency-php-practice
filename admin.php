<?php 
include_once("functions.php");
if (!isset($_SESSION['admin']))
{
echo "<h3/><span style='color:red;'>For Administrators Only!
</span><h3/>";
exit();
}

 ?>
<style>

</style>
<div class="container">
 <div class="row">
 	<div class="col-md-6 ">
 	  <table class='table'>
 	  	<thead>
 	  	<tr>
 	  		<th>Id</th>
 	  		<th>Country</th>
 	  		<th></th>
 	  	</tr>
 	  	</thead>

		<?php 

		$res=getCountries();
		if(isset($res)){
		echo "<tbody>";
		while($row=mysqli_fetch_array($res)) {
			 echo "<tr>";
			 echo "<td>".$row[0]."</td>";
			 echo "<td>".$row[1]."</td>";
			 echo "<td> <a class='btn btn-primary' href='delete.php?id=".$row[0]."&table=countries'>Delete</a></td>";
			 echo "</tr>";
		}
		echo "</tbody>";
	}
		 ?>
 	  </table>
  		<?php 
  			if(!isset($_POST['subm'])){
  		 ?>
  		 <hr>
  		 <div>
  		 	<form method="POST">
				<div class="form-group"><input type="text" name="country"></div>
				<div class="form-group"><input type="submit" name="subm" value="добавить страну"></div>
			</form>
  		 </div>
			
  	<?php 
  		}
  		else{
  			if(strlen($_POST['country'])>0)
  			{
  			  addCountry($_POST['country']);  			
				refreshPage();
  			  
			}
			else
				echo "pole ne doljno bit pystim";
  			}		
  	 ?>
 	</div>
	<div class="col-md-6 ">
		 <table class='table'>
 	  	<thead>
 	  	<tr>
 	  		<th>Id</th>
 	  		<th>City</th>
 	  		<th>ucity</th>
 	  		<th>Country</th>
 	  		<th></th>
 	  	</tr>
 	  	</thead>
		<?php 
		$resource=getCities();
		if(isset($resource)){
		echo "<tbody>";
		while($row=mysqli_fetch_array($resource)) {
			echo "<tr>";
			 echo "<td>".$row[0]."</td>";
			 echo "<td>".$row[1]."</td>";
			 echo "<td>".$row[2]."</td>";
			 echo "<td>".$row[3]."</td>";
			 echo "<td> <a class='btn btn-primary' href='delete.php?id=".$row[0]."&table=cities'>Delete</a></td>";
			echo "</tr>";

		}
		echo "</tbody>";
		}
	else
		echo "no data ";
		 ?>
 	  </table>
  		<?php 
  			$countries=getCountries();
  			if(!isset($_POST['subm2'])){
  		 ?>
  		 <hr>
  		 <div>
  		 	<form method="POST">
				<div class="form-group"><input type="text" name="city"></div>
				<div class="form-group">
					<select name="countryId" >
					<?php 
						while ($row=mysqli_fetch_array($countries)) {
							echo "<option value=".$row[0].">".$row[1]."</option>";

						#	echo "<input type='hidden' value='".$row[1].' name="cntry">';
						}

					 ?>
					</select>				

				</div>
				<div class="form-group"><input type="submit" name="subm2" value="добавить город"></div>

			</form>
  		 </div>
			
  	<?php 
  		}
  		else{
  			if(strlen($_POST['city'])>0)
  			{
  	  	 		addCity($_POST['city'],$_POST['countryId']);	
				refreshPage();
  				 
			}
			else
				echo "pole ne doljno bit pystim";
  		}		
  	 ?>
	</div>
 </div>
 <hr>
 <!-- HOTELS -->
 
 <div class="row nt">
 	<div class="col-md-6">
 		
 		<table class='table'>
 	  	<thead>
 	  	<tr>
 	  		<th>Id</th>
 	  		<th>Country-City</th>
 	  		<th>Hotel</th>
 	  		<th>Stars</th>
 	  		<th></th>
 	  	</tr>
 	  	</thead>

		<tbody>
			<?php 
			 $res=getHotels();
			 while ($row=mysqli_fetch_array($res)) {
			 	echo "<tr>";
			 	echo "<td>".$row[0]."</td>";
			 	echo "<td>".$row[1]."</td>";
			 	echo "<td>".$row[2]."</td>";
			 	echo "<td>".$row[3]."</td>";
			 	 echo "<td> <a class='btn btn-primary' href='delete.php?id=".$row[0]."&table=hotels'>Delete</a></td>";
			 	echo "</tr>";
			 }
			?>
		</tbody>
 	  </table>
 	
 	  <div>
 	  	<?php if(!isset($_POST['subm3'])) { ?>
 	  	
 	  		<form method="POST">
 	  			<div class="form-group">
 	  				<select name="city" >
 	  				<?php 
 	  				$resource=getCities();
						while ($row=mysqli_fetch_array($resource)) {
							echo "<option value=".$row[0].">".$row[2]."</option>";
				   	}
					 ?>
 	  				</select>
 	  			</div> 	  			
 	  			<div class="form-group"><input type="text" name='hotel'></div>
 	  			<div class="form-group"><input type="number" name='cost'></div>
 	  			<div class="form-group"><input type="number" name='stars'></div>
 	  			<div class="form-group"><textarea name='descr'></textarea></div>
 	  			<div class="form-group"><input type="submit" name='subm3' value='добавить отел'></div>
 	  		</form>
 	
 	  <?php 
 		}
 		else {
 				addHotel($_POST['hotel'],$_POST['city'],$_POST['stars'],$_POST['cost'],$_POST['descr']);
				refreshPage();
 				
 			
 		}
 	   ?>
 	  </div>

 	  
 	</div>
	

	<div class="col-md-6">
	<?php if (!isset($_POST['subm4'])){?>
		 <form method="POST" enctype="multipart/form-data">
		 	<select name="HotelId" >
		 	<?php 
		 		 $res=getHotels();
			 while ($row=mysqli_fetch_array($res)){
			 	echo "<option value=".$row[0].">".$row[2]."</option>";
			 } 
		 	 ?>
		 		
		 	</select>
 			<input type="file" name='fileUpload'>
 			<input type="submit" name = "subm4" value="dobavit izobrajenie">
 		</form>
 	</div>
		<?php }
			else
			{

				$uploaded= "/images/".($_FILES['fileUpload']['name']);
				if(isset($uploaded)){
					addImageToHotel($_POST['HotelId'],$uploaded);
				    refreshPage();
				}
			}
		 ?>
	
 </div>

</div>