<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="container">
	<?php include_once("functions.php") ;
	
	//$res=getHotelWithImagesById($_GET["id"]);
	$hotel =mysqli_fetch_row(getHotelWithImagesById($_GET["id"]));

	echo "<h2>".$hotel[1]."</h2>";
	echo "<div>";
	for ($i=0; $i < $hotel[2]; $i++) { 
		echo "<img src='star.jpg' style='width:75px;height=75px;'>";
	}
	echo "</div>";


	?>
	<div class="row">
		
	</div>
	<div class="row">
		 
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			    
				<?php
				include_once("functions.php") ;
				$images=getImagesByHotelId($_GET["id"]);
				$arr=[];
				while($row=mysqli_fetch_array($images)){
					array_push($arr, $row[0]);
				}
				for ($i=0; $i <count($arr) ; $i++) { 
					echo $arr[$i]; 
					echo "</br>";
				}
				//var_dump($arr);
				echo "<div class='carousel-item active'>
			      	<img src='".$arr[0]."' class='d-block w-100'>
			    	</div>";
				for ($i=1; $i <count($arr) ; $i++) { 
					echo "<div class='carousel-item'>";
					 echo "<img src='".$arr[$i]."'>";
					 echo "</div>";
				}
				
				?>	

			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>

		 
		

	</div>	
	<div class="row">
		<h4>Desciption</h4>			
		<p>
		</br>
			<?php echo  $hotel[4]; ?>

		</p>
	 </div>
	 </div>
</body>
	<script scr='js/bootstrap.js'></script>
 
</html>
