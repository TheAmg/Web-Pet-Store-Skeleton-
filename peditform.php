<!DOCTYPE html>
<html>
<head>
	<title>Edit product</title>
	<script type="text/javascript">
		var cnm="";
		var pid="";
        var pn="";
        var pd="";
        var pp="";
        function addToReg(pnm,pds,ppr)
        {
           pn=pnm;
           pd=pds;
           pp=ppr;

        }
        function constructPage()
        {
        		var paraID = document.createElement("P");
				paraID.style.border = "1px solid black";
				paraID.style.color = "black";
				paraID.style.width = "240px";
				paraID.innerText = "Current Product details:\nProduct Name: " + pn + "\nPrice: " + pp+"\nDescription: "+pd;
				document.body.appendChild(paraID);
        }
		function updateProd()
		{
			alert("Updating product details");
			var pcat=document.getElementById("catsel").value;
			var pname=document.getElementById("prodname").value;
			var pcost=parseInt(document.getElementById("prodprice").value);
			var pdes=document.getElementById("proddesc").value;
            location.replace("updateprod.php?UL="+cnm+"?"+pid+"?"+pcat+"?"+pname+"?"+pcost+"?"+pdes);
		}
		function removeProd()
		{
            alert("Removing product ");
            location.replace("removeprod.php?UL="+cnm+"?"+pid);
		}
		function setUsername(uname)
        {
           cnm = uname;
        }
        function setPid(prodid)
        {
           pid = prodid;
        }
	</script>
</head>
<body>
<?php
$data="Guest";
if (@$_GET['UL']==true) 
    {
        $data=$_GET['UL'];
    }
    $arr=explode("?", $data);
    $un=$arr[0];
    $pid=$arr[1];
   // echo "".$pid;
   echo "<script>
	      setUsername(\"".$un."\"); 
	      </script>";
	echo "<script>
	      setPid(\"".$pid."\"); 
	      </script>";

	      $conn = new mysqli('localhost', 'root', '', 'petstore');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE pid='".$pid."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<script> 
        addToReg(\"".$row["pname"]."\", \"".$row["pdesc"]."\",".$row["pprice"].");
        </script>";
    }
    echo "<script> 
    constructPage();
    </script>";
} 
else {
    echo "0 results";
}
$conn->close();

?>
<p>Update the details here</p>
<p>Select the category of the product</p>
<select id="catsel">
	<option value="F">Food</option>
	<option value="A">Accessories</option>
	<option value="P">Pet</option>
</select>
<br>
<p>Enter product name</p>
<input type="text" id="prodname" placeholder="Enter name of product">
<br>
<p>Enter product price</p>
<input type="text" id="prodprice" placeholder="Enter price">
<br>
<p>Enter product description</p>
<input type="text" id="proddesc" placeholder="Enter product description">
<br>
<br>
<button onclick="updateProd()">Update Details</button>
<button onclick="removeProd()">Remove from store</button>
</body>
</html>
