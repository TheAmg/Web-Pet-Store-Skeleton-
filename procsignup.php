<?php
  if (isset($_POST['sigButton'])) {
  	if (empty($_POST['sigName']) || empty($_POST['sigPass'])) {

  		echo "Enter something";
  	}
  	else
  	{
      $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "INSERT INTO users(uname,upwd,urole)VALUES ('".$_POST["sigName"]."','".$_POST["sigPass"]."','C')";

            if (mysqli_query($conn, $sql)) {
               //echo "Created account";
              header("location:login.html");
            } else {
               echo "That username already exists, pick another one";
            }
            $conn->close();
  	}

  }
?>