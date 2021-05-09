<?php
$arr="";
//$t1=[];
$un="";
$itd="";
$pcat="";
$pname="";
$pprice="";
$pdesc="";

if (@$_GET['UL']==true) 
    {
        $arr=$_GET['UL'];

    }

    $expa = explode("?", $arr);
        $un=$expa[0];
    	$itd=$expa[1];
        $pcat=$expa[2];
		$pname=$expa[3];
		$pprice=$expa[4];
		$pdesc=$expa[5];

$conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "UPDATE products SET pcat='".$pcat."',pname='".$pname."',pprice='".$pprice."',pdesc='".$pdesc."' WHERE pid='".$itd."'";

            if (mysqli_query($conn, $sql)) {
              echo "Updated<br>";
	  		  echo "<a href='managemenu.php?UL=".$un."'>Go Back</a>";
            } else {
               echo "Unable to Update ".mysqli_error($conn);
            }
            $conn->close();

?>