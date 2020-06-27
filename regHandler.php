<?php
include_once("functions.php");
$name = $_GET['name'];
$name = strtolower($name);
$response=login_exists($name)?"<p><span style='color:red;'> Логин занят </span> </p>"
:"<p><span style='color:green;'> Логин доступен</span> </p>";
echo $response;
?>
