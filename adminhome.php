<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
</head>
<body>
<?php
$un="";
if(@$_GET['UL']==true)
{
	$un=$_GET['UL'];
}
echo "Welocme ".$un;
?>
<br>
<form method="post">
	<input type="submit" name="manB" value="Manage Products">
	<input type="submit" name="addB" value="Add new Products">
</form>
<br>
<a href="login.html">Logout</a>

<?php
if(isset($_POST['manB']))
{
	header("location:managemenu.php?UL=".$un);
}
?>
<?php
if(isset($_POST['addB']))
{
	header("location:addprod.php?UL=".$un);
}
?>
</body>
</html>