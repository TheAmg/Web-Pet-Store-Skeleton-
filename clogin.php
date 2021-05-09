<?php
$username="Guest";
if (@$_GET['UL']==true) 
    {
        $username=$_GET['UL'];
    }
        
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Homepage</title>
</head>
<body>

<div name="chDB">
    <form method="post">
        <input type="submit" name="shopButton" value="Shop">
    </form>
<?php
if(isset($_POST['shopButton']))
{
    header("location:findpetsP.php?UL=".$username);
}
?>
	<p><a href="aboutus.html">About us</a></p>
	<p><a href="contact.html">Contact</a></p>
	<p>Welcome</p>
    <p><?php echo $username; ?></p>
</div>

<p><a href="login.html">Logout</a></p>
</body>
</html>