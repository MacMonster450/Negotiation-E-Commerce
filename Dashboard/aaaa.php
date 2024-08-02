<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product1</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		*{
	margin: 0;
	padding: 0;
	text-decoration: none;
	list-style: none;
}
body{
	font-style: Arial;
	/*background: url(lapwall.jpg) no-repeat;
	background-size: cover;*/
	padding-bottom: 8em;
}
nav.N1{
	height: 3rem;
	width: 100%;
	background: linear-gradient(to right,rgb(75, 74, 75),rgb(53, 51, 52));
}
nav.N1 label{
	font-size: 2em;
	color: white;
	line-height: 50px;
	padding: 0 50px;
	font-weight: bolder;
}
nav.N1 ul{
	float: right;
	padding-right: 40px;
}
nav.N1 li{
	display: inline-block;
	line-height: 50px;
	margin: 0 7px;
}
nav.N1 a{
	font-size: 1.1em;
	color: white;
	font-style: Arial;
	border: 1px solid transparent;
	border-radius: 4px;
	padding: 8px 10px;
}
nav.N1 a:hover{
	border: 1px solid white;
}



.form-popup {
  display: none;
  position: fixed;
  bottom: 20;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 2;
}
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #fff;
}

.form-container input[type=text] {
  width: 100%;
  padding: 8px;
  margin: 5px 0 15px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.form-container .btn {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 15px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom: 10px;
}
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.form-container .cancel {
  background-color: #ff3333;
}



.Product_Details{
	display: block;
	float: right;
}
.Name_Pro{
	margin-top: 4em;
	font-size: 2em;
	font-weight: bold;
}
.Despcription_Pro{
	margin-top: .5em;
	font-size: 1.3em;
}
.Price_Pro{
	margin-top: .5m;
}
.AddtoCart{
	margin-top: 1em;
	padding: 8px 25px 8px 25px;
	background-color: lightgreen;
	border-radius: 8px;
}
.NegoBut{
	margin-top: 1em;
	padding: 8px 25px 8px 25px;
	background-color: lightcyan;
	border-radius: 8px;
	border: 1px solid black;
}



@media (max-width: 2560){
	nav.content{
		width: 2560px;
	}
}


@media (max-width: 1024px){

	nav.content{
		width: 1024px;
	}
}


@media (max-width: 905px){
	nav.N1 label{
		font-size: 2.1em;
		padding: 0 61px;
	}
	nav.N1 ul{
		padding-right: 18px;
	}
	nav.N1 li{
		margin: 0 5.5px;
	}
	nav.N1 a{
		font-size: 1em;
		padding: 7.2px 9.2px;
	}
	nav.content{
		width: 768px;
	}
}


@media (max-width: 778px)
{
	nav.N1{
		height: 4rem;
	}
	nav.N1 label{
		font-size: 2rem;
		line-height: 60px;
		padding: 0 60px;
	}
	nav.N1 ul{
		padding-right: 15px;
	}
	nav.N1 li{
		margin: 0 5px;
		line-height: 70px;
	}
	nav.N1 a{
		font-size: 0.9rem;
		padding: 7px 9px;
	}
}


@media (max-width: 730px){
	
	nav.N1 ul{
		position: fixed;
		width: 65%;
		height: 20vh;
		display: flex;
		background-color: black;
		left: -100%;
		transition: all 0.5s;
	}
	nav.N1 li{
		display: block;
		width: 100%;
	}
	nav.N1 ul.slide{
		left: 0%;
		transition: all 0.5s;
	}
	nav.content{
		width: 730px;
		height: auto;
		margin: auto;
		color: white;
		position: relative;
	}

}


@media (max-width: 425px)
{
	body{
		padding-bottom: 18em;
	}
	nav.N1 label{
		font-size: 1.5rem;
		padding: 0 50px;
	}
	nav.N1 ul{
		width: 93%;
		height: 12vh;
	}

	nav.content{
		width: 425px;
	}
}


@media (max-width: 375px)
{
	
	nav.N1 label{
		font-size: 1.5rem;
		padding: 0 50px;
	}
	nav.N1 ul{
		width: 95%;
		height: 13vh;
	}
	nav.N1 li{
		margin: 0 1.5px;
	}
	nav.content{
		width: 375px;
	}
}


@media (max-width: 320px)
{
	nav.N1 label{
		font-size: 1.5rem;
		padding: 0 50px;
	}
	nav.N1 ul{
		width: 93%;
		height: 12vh;
	}
	nav.N1 li{
		margin: 0;
	}
	nav.N1 a{
		font-size: 0.8em;
		padding: 5px 7px;
	}
	nav.content{
		width: 320px;
	}
}
	</style>
</head>
<body>
	<nav class="N1">
		<label class="logo">Hawk</label>
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="" class="cart"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
            <li><input type="submit" onclick="openForm()" value ="Profile" style="background-color:rgb(53, 51, 52);color: white;font-style: Arial;border: none;font-size: 1em;cursor: pointer;"></li>
            <div class="form-popup" id="myForm">
              <form method="post" class="form-container" style="margin: .8em;">
                <input type="submit" onclick="closeForm()" value="Close" style=";float: right;color: red;background-color: white; font-style: Arial;border: none;font-size: 1em;cursor: pointer;margin-bottom: 1em;">
                <center><h2 style="margin-top: 1.1em;margin-bottom: .5em;"><?php session_start();$username = $_SESSION['Fullname'];echo $username; ?></h2></center>
                <a href="../../User/Dashboard/" style="color: black;border: 1px black solid;">Change To Seller Account</a>
              </form>
            </div>
            <script type="text/javascript">
                 function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  // Function to close the popup form
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }   
            </script>
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
				<img src="../../Products/Images/Image.jpg" height="500" width="600" alt="Product 1">
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
	if ($_SERVER['REQUEST_METHOD'] === "POST")
	{
		$Token = "Product123";
		if (isset($_POST['Negotiation']))
		{
			$_SESSION['Token'] = $Token;
			setcookie("PriceError", " ");
			echo "<script> location.href='../../Negotiation/Customer'; </script>";
		}
		
	}
?>