<?php
$arr=[];
$t1=[];
$un="";
$itd="";

if (@$_GET['Dat']==true) 
    {
        $arr=$_GET['Dat'];
        $tl=explode(" ", $arr);
        $un=$tl[0];
        $itd=$tl[1];
    }

     $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "DELETE FROM cart WHERE cid='".$itd."'";

            if (mysqli_query($conn, $sql)) {
              header("location:viewCart.php?UL=".$un);
            } else {
               echo "Unable to remove from cart";
            }
            $conn->close();

?>