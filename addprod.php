<!DOCTYPE html>
<html>
<head>
	<title>Add products</title>
	<script type="text/javascript">

		var cnm="";

		function setUsername(uname)
		{
			//alert("Reg user "+uname);
			cnm=uname;
		}

		function addProd()
		{   
            
			var pcat=document.getElementById("catsel").value;
			var pname=document.getElementById("prodname").value;
			var pprice=parseInt(document.getElementById("prodprice").value);
			var pdes=document.getElementById("proddesc").value;
            alert("Adding product "+pname);
			location.replace("anp.php?UL="+pcat+"?"+pname+"?"+pprice+"?"+pdes+"?"+cnm);

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
    echo "".$username."<br>";
    echo "<script>
	      setUsername(\"".$username."\"); 
	      </script>";
?>
<p>Select the category of the product</p>
<select id="catsel">
	<option value="F">Food</option>
	<option value="A">Accessories</option>
	<option value="P">Pet</option>
</select>
<br>
<p>Enter product name</p>
<br>
<input type="text" id="prodname" placeholder="Enter name of product">
<br>
<p>Enter product price</p>
<br>
<input type="text" id="prodprice" placeholder="Enter price">
<br>
<p>Enter product description</p>
<br>
<input type="text" id="proddesc" placeholder="Enter product description">
<br>
<button onclick="addProd()">Add Product</button>
</body>
</html>