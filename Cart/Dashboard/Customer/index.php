<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav class="N1">
		<label class="logo">Hawk</label>
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="../../Cart/Dashboard/Signin" class="cart"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
            <li><input type="submit" onclick="openForm()" value ="Profile" style="background-color:rgb(53, 51, 52);color: white;font-style: Arial;border: none;font-size: 1em;cursor: pointer;"></li>
            <div class="form-popup" id="myForm">
              <form method="post" class="form-container" style="margin: .8em;">
                <input type="submit" onclick="closeForm()" value="Close" style=";float: right;color: red;background-color: white; font-style: Arial;border: none;font-size: 1em;cursor: pointer;margin-bottom: 1em;">
                <center><h2 style="margin-top: 1.1em;margin-bottom: .5em;"><?php session_start();$username = $_SESSION['Fullname'];echo $username; ?></h2></center>
                <a href="../../../User/Dashboard/" style="color: black;border: 1px black solid;">Change To Seller Account</a>
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
	<div style="border: 1px solid black;padding: 10px 10px 10px 10px;">
		<center><h1>Cart</h1></center>
		<!-- TopInsertAdditionalCodeHere -->


    

	</div>

	

</body>
</html>