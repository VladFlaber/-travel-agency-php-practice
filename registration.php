<?php
	
	if(!isset($_POST['subm'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method='POST' enctype="multipart/form-data">
		<div class="form-group">
		<input type="text" id='reglog' name='login' placeholder="login" oninput="Process()">			
		</div>
		<div id="res2"></div>
		<div class="form-group">
		<input type="password" name='psw' placeholder="password">	
		</div>
		<div class="form-group">
		<input type="password" name='chkpsw' placeholder="confirm passwod">		
		</div>
		<div class="form-group">
		<input type="email" name='email' placeholder="email">		
		</div>
		<div class="form-group">
		<input type="file" name='uploadFile' accept='.gif,.jpg,.jpeg,.png'>			
		</div>
		<div class="form-group">
		<input type="submit" name='subm'>			
		</div>
	</form>
</body>
</html>
<?php 
}
else {
	$reg =registration($_POST['login'],$_POST['psw'],$_POST['chkpsw'],$_POST['email'],$_POST['uploadFile']);
	if($reg==1)
		echo 'reg succeed';
	else if ($reg==0)
		echo "login exists";
	else 
		echo "reg failed";

}
?>