<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product1</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav class="N1">
		<label class="logo">Hawk</label>
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="../../Signin" class="signin">Sign in</a></li>
			<li><a href="" class="cart"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
		</ul>

		<div class="icon">
			<label class="line"></label>
			<label class="line"></label>
			<label class="line"></label>
		</div>

	</nav>
	<form method="POST">
		<div class="container">
			<div>
				<img src="../../Products/Images/Product1.jpg" height="500" width="600" alt="Product 1">
				<div class="Product_Details">
					<p class="Name_Pro">Product1</p>
					<p class="Despcription_Pro">Description of Product 1.</p>
         	<p class="Price_Pro">₹99.99</p>
         	<input type="submit" name="AddtoCart" class="AddtoCart" value="Add to Cart">
         	<input type="submit" name="Negotiation" class="NegoBut" value="Negotiation">
         </div>
			</div>
		</div>
	</form>
</body>
</html>
<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] === "POST")
	{
		$Token = "Product123";
		if (isset($_POST['Negotiation']))
		{
			$_SESSION['Token'] = $Token;
			setcookie("PriceError", " ");
			echo "<script> location.href='../../Signin'; </script>";
		}
		
	}
?>