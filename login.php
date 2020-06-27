
<?php 
	if(isset($_SESSION['admin'])||isset($_SESSION['user']))
	{
		
		if(isset($_POST['logout'])){
			session_unset();
			refreshPage();
		}
		else{
		echo "<form method='POST'>";
		echo "<input type='submit' value='logout' name ='logout'>";
		echo "</form>";
		}
	}
	else{
	if(isset($_POST['subm'])){
		 $user=login($_POST['login'],$_POST['psw']);
		 if(isset($user)){
		 	if($user[4]==0)
		 	{
		 	$_SESSION['user']=$user[0];
		 	echo "logined as user";
		 	}
		 	else{
		 	echo "logined as admin";
		 	$_SESSION['admin']=$user[0];
		 	}
			refreshPage();

		 }
		
	}

	else {
 ?>
 <div >
<form method="POST">
	<input type="text" name='login' placeholder="login">
	<input type="password" name='psw' placeholder="password">
	<input type="submit" name='subm'>
</form>
</div>
 <?php } }?>
	
	