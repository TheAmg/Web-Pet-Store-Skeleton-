<?php
$username="Guest";
if (@$_GET['UL']==true) 
    {
        $username=$_GET['UL'];
    }
    echo "".$username;        
?>
<!DOCTYPE html>
<html>
<head>
	<title>Find pets</title>
	<script type="text/javascript">
		var prids=[];
		var prnames=[];
		var prdescs=[];
		var prprices=[];
		var cntr=0;
		var cnm = "";

		var Curcart=[];
		var cCost=[];
		var cartcntr=0;
		function addToReg(apid, apname, apdesc, apprice)
		{   
			prids[cntr]=apid;
			prnames[cntr]=apname;
			prdescs[cntr]=apdesc;
			prprices[cntr]=apprice;
			//alert("registering id "+prids[cntr]+" price "+apprice+"="+prprices[cntr]+" index "+cntr+" for "+apname);
			cntr++;	
		}
		function getPriceForId(idval)
		{
			for(var i=0;i<prids.length;i++)
			{
				if(idval==prids[i])
				{
					return prprices[i];
				}
			}
			return 0;
		}
		function constructPage()
		{
			//alert("Constructing page 1");
            for(var i=0;i<prids.length;i++)
            {
				var paraID = document.createElement("P");
				paraID.style.background = "blue";
				paraID.style.color = "white";
				paraID.style.width = "200px";
				paraID.style.height = "50px";
				paraID.innerText = "Product: " + prnames[i] + "\nPrice: " + prprices[i];
				document.body.appendChild(paraID);

				var btn = document.createElement("BUTTON");
				btn.setAttribute("id", ""+ prids[i]);
				btn.innerText = "Add to cart";
				btn.onclick=function(){alert("Adding to cart"); Curcart[cartcntr]=this.id;
				var spri=0; 
                for (var v=0;v<prids.length;v++)
                {
                   if(prids[v]==this.id)
                   {
                   	spri=prprices[v];
                   }
                }
				cCost[cartcntr]=spri; 
				cartcntr++; 
                location.replace("pushToCart.php?Dat="+cnm+"+"+Curcart[cartcntr-1]+"+"+cCost[cartcntr-1]);
			    };
				document.body.appendChild(btn); 
                
            }
		}
		function checkReg()
		{
			alert("new items length "+ Curcart.length + " entities , username is : "+cnm);
		}
        function setUsername(uname)
        {
           cnm = uname;
        }
        function gotocart()
        {
           location.replace("viewCart.php?UL="+cnm);
        }
	</script>
</head>
<body>
<?php
if($username!="Guest")
{
	echo "<script>
	      setUsername(\"".$username."\"); 
	      </script>";
}
$conn = new mysqli('localhost', 'root', '', 'petstore');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<script> 
        addToReg(".$row["pid"].",\"".$row["pname"]."\", \"".$row["pdesc"]."\",".$row["pprice"].");
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
<br>

<button onclick="gotocart()">View cart</button>
</body>
</html>
