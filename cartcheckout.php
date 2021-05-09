<?php
$un="";

if (@$_GET['UL']==true) 
    {
        $un=$_GET['UL'];
    }

   $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "DELETE FROM cart WHERE cname='".$un."'";

            if (mysqli_query($conn, $sql)) {
               
              echo "Purchase order registered <br>";
              echo "<a href='viewCart.php?UL=".$un."'>Go Back</a>";
            } else {
               echo "Unable to Checkout";
            }
            $conn->close();

?>