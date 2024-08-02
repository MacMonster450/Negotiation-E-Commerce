<?php
	setcookie("PriceError", " ");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Negotiation</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
        	setInterval(function(){
          	$("#Messages").load("Getmessage.php").fadeIn("slow");
          		refresh();
        		}, 0);
      		});
	</script>

</head>
<body>
	<form method="POST">
		<div class="container">
			<div>
				<h1 class="Topic">Negotiation</h1>
			</div>
			<div>
				<label class="ProductName">Product Name :</label>
				<input type="text" name="ProductName" class="ProductNameInp" value="Canon" disabled>
			</div>
			<div>
				<label class="CurPrice">Current Price :</label>
				<input type="text" name="CurPrice" class="CurPriceInp" value="₹79000" disabled>
				<label class="NegoPrice">Negotiation</label>
				<input type="number" name="NegotiationPrice" class="NegoPriceInp" placeholder="Enter a Amount...">
			</div>
			<div class="DesBox">
				<label class="Descrip">Desprition (Optional)</label>
				<textarea class="DescripBox" name="DescripBox" placeholder="Optional"></textarea>
			</div>
			<div class="SubBox">
				<input type="submit" name="Submit" class="Sub" value="Submit">
			</div>
			<div class="MessPanel">
				<label class="MessText">Messages</label>
				<div class="Messages" id="Messages">
					
				</div>
			</div>
		</div>
	</form>
</body>
</html>
<?php
	require "../../../Config/config.php";
	require "../../Emailsender.php";
	if ($_SERVER["REQUEST_METHOD"] === "POST") 
	{
		$Message = $_POST["NegotiationPrice"];
		$Description = $_POST["DescripBox"];
		$conn = OpenCon();
		if (isset($_POST["Submit"]))
		{
			if ($Message === "")
			{
				setcookie("PriceError", "<p style='color: red;font-size: .7em;margin-left: 38em;'>Invalid</p>");
            	echo "<meta http-equiv='refresh' content='0; URL='>";
			}
			else if ($Message === "0")
			{
				setcookie("PriceError", "<p style='color: red;font-size: .7em;margin-left: 38em;'>Invalid</p>");
            	echo "<meta http-equiv='refresh' content='0; URL='>";
			}
			else
			{
				$AddMessage = $conn->prepare("INSERT INTO neg2d902ce73e(CoversaTion,Description,CusORSell) VALUES('I Want this product for this price ₹$Message at ', '$Description', 'Cus');");
				if ($AddMessage->execute()) 
				{
						Email_Verification("suryasiva1130@gmail.com", "Surya", "79000", "9a731f182e2d41ab27ea0a6a41ded15a3befc05f5626cd21f639c332abb104672e0f83f8" ,"$Message");
					echo "<meta http-equiv='refresh' content='0; URL='>";
				}
				else
				{
					echo "Tryagain somthing want wrong.";
				}
			}
		}
		CloseCon($conn);
	}
?>