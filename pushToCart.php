<?php

    $arr=[];
    $tl=[];
    $un="";
    $pidr="";
    $pcost="";
    if (@$_GET['Dat']==true) 
    {
        $arr=$_GET['Dat'];
        $tl=explode(" ", $arr);
        $un=$tl[0];
        $pidr=$tl[1];
        $pcost=$tl[2];
    }
    echo "u".$un."<br>";
    echo "p".$pidr."<br>";
    echo "c".$pcost."<br>";
      $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "INSERT INTO cart(cname,proid,pcost)VALUES ('".$un."','".$pidr."','".$pcost."')";

            if (mysqli_query($conn, $sql)) {
               //echo "Created account";
              header("location:findpetsP.php?UL=".$un);
              //echo "added to cart successfully";
            } else {
               echo "Failed to add to cart, check your internet";
            }
            $conn->close();
?>