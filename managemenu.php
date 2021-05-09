<!DOCTYPE html>
<html>
<head>
	<title>Manage menu</title>
	<script type="text/javascript">
		var cnm="";
        var prids=[];
		var prnames=[];
		var prdescs=[];
		var prprices=[];
		var cntr=0;

		function addToReg(apid, apname, apdesc, apprice)
		{   
			prids[cntr]=apid;
			prnames[cntr]=apname;
			prdescs[cntr]=apdesc;
			prprices[cntr]=apprice;
			cntr++;	
		}
		function constructPage()
		{
			//alert("Constructing page 1");
            for(var i=0;i<prids.length;i++)
            {
				var paraID = document.createElement("P");
				paraID.style.background = "#00aa55";
				paraID.style.color = "white";
				paraID.style.border = "1px solid black";
				paraID.style.width = "200px";
				paraID.style.height = "50px";
				paraID.innerText = "Product: " + prnames[i] + "\nPrice: " + prprices[i];
				document.body.appendChild(paraID);

				var btn = document.createElement("BUTTON");
				btn.setAttribute("id", ""+ prids[i]);
				btn.innerText = "Edit";
				btn.onclick=function(){
                location.replace("peditform.php?UL="+cnm+"?"+this.id);
			    };
				document.body.appendChild(btn); 
                
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
    echo "<script>
	      setUsername(\"".$username."\"); 
	      </script>";
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

</body>
</html>