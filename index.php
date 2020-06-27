<?php
 include('functions.php');
		 	session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<header><?php include_once("login.php") ?></header>
		</div>
		<div class="row">
		<nav class="col-sm-12 col-md-12 col-lg-12 navbar navbar-expand-lg navbar-dark bg-dark"> 
			<div class="collapse navbar-collapse">
			<?php include_once('menu.php'); ?>
			</div>
		</nav>
	</div>
	<div class="row">
		<section class="col-sm-12 col-md-12 col-lg-12">
			<?php 
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
				if($page==1)include_once('index.php');
				if($page==2)include_once('tours.php');
				if($page==3)include_once('comments.php');
				if($page==4)include_once('registration.php');
				if($page==5)include_once('admin.php');
				if($page==6 && isset($_SESSION['admin']))
				include_once("private.php");

			}
			?>
		</section>
	</div>
	</div>

</body>
	<script scr='js/bootstrap.js'></script>
	<script src="https://code.jquery.com/jquery-git.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="/js/site.js"></script>
</html>
