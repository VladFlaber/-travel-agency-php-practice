
<ul class="nav">
	<li class="nav-link"> <a href="index.php?page=1">Home</a></li>
	<li class="nav-link"> <a href="index.php?page=2.php">Tours</a></li>
	<li class="nav-link"> <a href="index.php?page=3.php">Comments</a></li>
	<li class="nav-link"> <a href="index.php?page=4.php">Registration</a></li>
	<li class="nav-link"> <a href="index.php?page=5.php">Admin</a></li>
	<?php
if(isset($_SESSION['admin']))
{
echo '<li class="nav-link">
<a href="index.php?page=6">Private</a></li>';
}
?>
</ul>
