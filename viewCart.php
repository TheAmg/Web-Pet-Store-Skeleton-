
<!DOCTYPE html>
<html>
<head>
	<title>View cart</title>
  <script type="text/javascript">
    var cids=[];
    var pids=[];
    var prnms=[];
    var prprices=[];
    var gc=0;

    var cnm = "";

    function regData(rcid,rpid,rpnms,rprice)
    {
      cids[gc]=rcid;
      pids[gc]=rpid;
      prnms[gc]=rpnms;
      prprices[gc]=rprice;
      gc++;
    }
    function constructPage()
    {
      for(var i=0;i<cids.length;i++)
      {
       var pt = document.createElement("P");
       pt.innerText="Name: "+prnms[i]+"\nCost: "+prprices[i];
       pt.style.border="1px solid black";
       pt.style.width="200px";
       pt.style.color="white";
       pt.style.background="#aa9900";
       document.body.appendChild(pt);

       var btn = document.createElement("BUTTON");
       btn.setAttribute("id",""+i);
       btn.innerText="Remove from cart";
       btn.onclick=function(){
         alert("Deleting item "+prnms[this.id]+" from the cart");
         location.replace("deletefromcart.php?Dat="+cnm+"+"+cids[this.id]);
       };
       document.body.appendChild(btn); 
      }
     
    }
    function checkout()
    {
      if(cids.length==0)
      {
       alert("Your cart is empty");
      }
      else
      {
       alert("Proceeding to checkout");
       location.replace("cartcheckout.php?UL="+cnm); 
      }
      
    }
    function clearCart()
    {
      if(cids.length==0)
      {
        alert("Your cart is already empty");
      }
      else
      {
        alert("Clearing cart");
      location.replace("clearcart.php?UL="+cnm);
      }
      
    }
    function setUsername(uname)
        {
           cnm = uname;
        }

  </script>
</head>
<body>
<?php
$username="Guest";
if (@$_GET['UL']==true) 
    {
        $username=$_GET['UL'];
    }
    echo "".$username;
?>
<?php
if($username!="Guest")
{
  echo "<script>
        setUsername(\"".$username."\"); 
        </script>";
}
$prodids=[];
$prodnames=[];
$prodC=0;
$v=0;

$tot_cost=0;
$conn = new mysqli('localhost', 'root', '', 'petstore');

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $query = "select * from cart where cname='".$username."'";
      $res = mysqli_query($conn,$query);
      
      $query1 = "select * from products";
      $res1 = mysqli_query($conn,$query1);

      if ($res1->num_rows > 0) {
    while($row = $res1->fetch_assoc()) {
      
        $prodids[$prodC]=$row["pid"];
        $prodnames[$prodC]=$row["pname"];
        $prodC++;
    }

    }
      if ($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        
        for($v=0;$v<sizeof($prodnames);$v++)
        {
        	if($row["proid"]==$prodids[$v])
        	{
            echo "<script> regData(".$row["cid"].",".$row["proid"].",\"".$prodnames[$v]."\",".$row["pcost"]."); </script>";
        		$tot_cost=$tot_cost+$row["pcost"];
        	}
        }
    }
    echo "<script>constructPage();</script>";
}
echo "<br>";
echo "<br> Total cost is : ".$tot_cost."<br>";
?>
<br>
<button onclick="clearCart()">Clear cart</button>
<button onclick="checkout()">Checkout</button>
</body>
</html>