<?php
$arr=[];
$t1=[];
$un="";
$itd="";

if (@$_GET['UL']==true) 
    {
        $arr=$_GET['UL'];
        $tl=explode("?", $arr);
        $un=$tl[0];
        $itd=$tl[1];
        

        //echo "".$itd;
    }

   $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }

	  $sql = "SELECT * FROM cart WHERE proid='".$itd."'";
	  $result = $conn->query($sql);

	  if ($result->num_rows > 0) {
	  	echo "Cant remove this product as there are customers who have this in their cart<br>";
	  	echo "<a href='managemenu.php?UL=".$un."'>Go Back</a>";
      } 
else {

    $sql1 = "DELETE FROM products WHERE pid='".$itd."'";

            if (mysqli_query($conn, $sql1)) {
              echo "Removed Product from store<br>";
	  		  echo "<a href='managemenu.php?UL=".$un."'>Go Back</a>";
            } else {
               echo "Unable to remove product from store ".mysqli_error($conn);
            }   
}
$conn->close();
?>