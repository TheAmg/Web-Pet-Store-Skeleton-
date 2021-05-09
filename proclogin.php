<?php
  if (isset($_POST['logButton'])) {
  	if (empty($_POST['logName']) || empty($_POST['logPass'])) {

  		echo "Enter something";
  	}
  	else
  	{
      $conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $query = "select * from users where uname='".$_POST['logName']."' and upwd='".$_POST['logPass']."'";
      $res = mysqli_query($conn,$query);

      if($row=$res->fetch_assoc())
      {
        $conn->close();
        if($row["urole"]=="A")
        {
          header("location:adminhome.php?UL=".$_POST['logName']);
        }
        else
        {
          header("location:clogin.php?UL=".$_POST['logName']);
        }

      }
      else
      { 
      	$conn->close();
       	header("location:login.html?No such account");
      }
  	}

  }
?>