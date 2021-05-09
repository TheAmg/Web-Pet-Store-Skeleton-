<?php

$data="";
if (@$_GET['UL']==true) 
    {
        $data=$_GET['UL'];
    }

    $arr=explode("?", $data);
    $cate=$arr[0];
    $pname=$arr[1];
    $pcost=$arr[2];
    $pdes=$arr[3];
    $un=$arr[4];

    $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "INSERT INTO products(pcat,pname,pprice,pdesc) VALUES ('".$cate."','".$pname."','".$pcost."','".$pdes."')";

            if (mysqli_query($conn, $sql)) {
               //echo "Created account";
              header("location:addprod.php?UL=".$un);
            } else {
               echo "failed to enter, choose a unique name";
               echo "<a href='addprod.php?UL=".$un."'> Go back </a>";
            }
            $conn->close();

?>