<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Product</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		*{
	margin: 0;
	padding: 0;
	text-decoration: none;
}
body{
	display: flex;
	justify-content: center;
	align-items: center;
}
.container{
	max-width: 600px;
    margin: 80px auto;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    display: block;
}
.Topic{
	display: flex;
	justify-content: center;
	margin-bottom: 1em;
	font-size: 1.9em;
	font-weight: sold;
}
.ProductName{
	font-size: 1.1em;
	margin-right: 1em;
}
.ProductNameInp{
	padding: auto;
	border-radius: 5px;
	font-size: .9em;
}
.ProductPrice{
	margin-top: 1.5em;
	font-size: 1.1em;
	margin-right: 1em;
}
.PoductPriceInp{
	margin-top: 1.5em;
	border-radius: 5px;
	padding-left: 2px;
}
.DesBox{
	display: grid;
	grid-template-columns: 10em;
	margin-top: 1.5em;
}
.Descrip{
	font-size: 1em;
	margin-bottom: .5em;
}
.DescriptionOfProj{
	width: 20em;
	height: 10vh;
	padding: 5px;
}
.SubBox{
	display: flex;
	justify-content: center;
	align-items: center;
	margin-top: 1em;
}
.Sub{
	padding: 5px;
	font-size: .9em;
	border-radius: 5px;
	border: 1px solid black;
}
.MessText{
	font-size: 1.05em;
}
.Messages{
	margin-top: .5em;
	padding: 30px 30px 120px 30px;
	border: 1px solid black;
}
	</style>
</head>
<body>
	<form method="POST">
		<div class="container">
			<div>
				<label class="ProductName">Product Name</label>
				<input type="text" name="ProductName" class="ProductNameInp" placeholder="Product Name">
			</div>
			<div class="DesBox">
				<label class="Descrip">Description</label>
				<textarea class="DescriptionOfProj" name="DescriptionOfProduct" placeholder="Description"></textarea>
			</div>
			<div>
				<label class="ProductPrice">Price</label>
				<input type="number" name="PoductPrice" class="PoductPriceInp" placeholder="Price">
			</div>
			<div class="SubBox">
				<input type="submit" name="Submit" class="sub" value="Submit">
			</div>
		</div>
	</form>
</body>
</html>
<?php
	session_start();
	require '../../Config/config.php';
	if ($_SERVER['REQUEST_METHOD'] === "POST") 
	{
		$conn = OpenCon();
		$Productname = $_POST['ProductName'];
		$Productdescription = $_POST['DescriptionOfProduct'];
		$Productprice = $_POST['PoductPrice'];
		$SALT = "A!B@C#D%E^F&G*H(I)O_P-L+K=J";
		$Productkey = sha1($Productname.$SALT) . substr(md5(mt_rand()), 0, 70);
		$SmallKey = substr(md5(mt_rand()), 0, 10);
		$words = explode(" ", $Productdescription);

		$Desp = '';
		
		$count = count($words);
		for ($i = 0; $i < $count; $i++) {
		    $Desp .= $words[$i] . " ";
		    
		    if (($i + 1) % 3 == 0) {

		        $Desp .= "<br>";
		    }
		}
		$ExtraDesp = '';
		
		$count = count($words);
		for ($i = 0; $i < $count; $i++) {
		    $ExtraDesp .= $words[$i] . " ";
		    
		    if (($i + 1) % 8 == 0) {

		        $ExtraDesp .= "<br>";
		    }
		}

		if (isset($_POST['Submit'])) 
		{
			if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }

				$InsertProduct = "INSERT INTO products(ProductName, ProductDescription, ProductPrice, ProductKey) VALUES('$Productname', '$Desp', '$Productprice', '$Productkey');";
				if(mysqli_query($conn, $InsertProduct))
				{


					$directory = "../../Products/" ."$Productkey";
					$directory_2 = "../../Negotiation/Customer/"  ."$SmallKey";

                if (!is_dir($directory) && !is_dir($directory_2))
                {
                
                    if (mkdir($directory, 0755, true) && mkdir($directory_2, 0755, true)) 
                    {
    
        
                        function createAndWriteToFile($filename, $content) 
                        {
                        
                            $file = fopen($filename, 'w');
                        
                        
                            if ($file === false) {
                                die("Error: Unable to open file.");
                            }
                        
                        
                            fwrite($file, $content);
                        
                        
                            fclose($file);
                        }
                        $Redirect = "<script> location.href='../../Negotiation/Customer/" . $SmallKey . "'; </script>";
                        
                        $phpFileContent = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>'. $Productname . '</title>
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
                <center><h2 style="margin-top: 1.1em;margin-bottom: .5em;"><?php session_start();$username = $_SESSION["Fullname"];echo $username; ?></h2></center>
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
				<img src="../../Products/' . $Productkey .'/Image.jpg" height="500" width="600" alt="Product 1">
				<div class="Product_Details">
					<p class="Name_Pro">'. $Productname .'</p>
					<p class="Despcription_Pro">' . $ExtraDesp . '</p>
         	<p class="Price_Pro">₹' . $Productprice . '</p>
         	<input type="submit" name="AddtoCart" class="AddtoCart" value="Add to Cart">
         	<input type="submit" name="Negotiation" class="NegoBut" value="Negotiation">
        </div>
			</div>
		</div>
	</form>
</body>
</html>
<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST")
	{
		$Token = "Product123";
		if (isset($_POST["Negotiation"]))
		{
			$_SESSION["Token"] = $Token;
			echo "'. $Redirect . '";
		}
		
	}
?>';


												$Para = "<p style='color: red;font-size: .7em;margin-left: 38em;'>Invalid</p>";
												$Meta = "<meta http-equiv='refresh' content='0; URL='>";
												$Ans1 = 'I Want this product for this price ₹$Message at ';
												$Ans2 = '$Description';
												$Ans3 = 'Cus';
												$SQL = "INSERT INTO neg$SmallKey(CoversaTion,Description,CusORSell) VALUES('" . $Ans1 . "', '" . $Ans2 . "', '" . $Ans3 . "');";
												$phpFileContent_1 = '<?php
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
				<input type="text" name="ProductName" class="ProductNameInp" value="'. $Productname .'" disabled>
			</div>
			<div>
				<label class="CurPrice">Current Price :</label>
				<input type="text" name="CurPrice" class="CurPriceInp" value="₹'. $Productprice .'" disabled>
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
				setcookie("PriceError", "' . $Para . '");
            	echo "' . $Meta . '";
			}
			else if ($Message === "0")
			{
				setcookie("PriceError", "' . $Para . '");
            	echo "' . $Meta . '";
			}
			else
			{
				$AddMessage = $conn->prepare("' . $SQL .'");
				if ($AddMessage->execute()) 
				{
						Email_Verification("suryasiva1130@gmail.com", "' . $ProductName . '", "' . $Productprice . '", "' . $Productkey . '" ,"$Message", "neg' . $SmallKey . '");
					echo "' . $Meta . '";
				}
				else
				{
					echo "Tryagain somthing want wrong.";
				}
			}
		}
		CloseCon($conn);
	}
?>';

												$phpFileContent_2 = '*{
	margin: 0;
	padding: 0;
	text-decoration: none;
}
body{
	display: flex;
	justify-content: center;
	align-items: center;
}
.container{
	max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    display: block;
}
.Topic{
	display: flex;
	justify-content: center;
	margin-bottom: 1em;
	font-size: 1.9em;
	font-weight: sold;
}
.ProductName{
	font-size: 1.1em;
	margin-right: 1em;
}
.ProductNameInp{
	padding: auto;
	border-radius: 5px;
	font-size: .9em;
}
.CurPrice{
	margin-top: 1.5em;
	font-size: 1.1em;
	margin-right: 1em;
}
.CurPriceInp{
	margin-top: 1.5em;
	border-radius: 5px;
	padding-left: 2px;
}
.NegoPrice{
	margin-top: 1.5em;
	font-size: 1.1em;
	margin-right: 1em;
	margin-left: 1em;
}
.NegoPriceInp{
	margin-top: 1.5em;
	border-radius: 5px;
	padding: 1px 0px 1px 4px;
	border: 1px solid black;
}
.DesBox{
	display: grid;
	grid-template-columns: 10em;
	margin-top: 1.5em;
}
.Descrip{
	font-size: 1em;
	margin-bottom: .5em;
}
.DescripBox{
	width: 44em;
	height: 10vh;
	padding: 5px;
}
.SubBox{
	display: flex;
	justify-content: center;
	align-items: center;
	margin-top: 1em;
}
.Sub{
	padding: 5px;
	font-size: .9em;
	border-radius: 5px;
	border: 1px solid black;
}
.MessText{
	font-size: 1.05em;
}
.Messages{
	margin-top: .5em;
	padding: 30px 30px 120px 30px;
	border: 1px solid black;
}';
												

												$SQL1 = "SELECT 1 FROM information_schema.tables WHERE table_schema = 'registerui' AND table_name = 'neg" . $SmallKey . "' LIMIT 1";
												$phpFileContent_3 = '<?php
	require "../../../Config/config.php";
	require "../../Emailsender.php";
	$conn = OpenCon();
	$tableName = "negf76e5aef6e";
	$A = "' . $SQL1 . '";
	$tableCheckResult = $conn->query($A);
	//$FindTableExist = $conn->query("SHOW TABLES LIKE $tableName");
	if ($tableCheckResult && $tableCheckResult->num_rows > 0) 
	{
			$GetTextMessage = mysqli_query($conn,"SELECT * FROM neg'. $SmallKey .';");
			while ($Message = mysqli_fetch_array($GetTextMessage))
			{
				if($Message["CusORSell"] === "Cus")
				{
					$User = "You";
				}
				else
				{
					$User = "Seller";
				}
			
				echo "<div class=" . $Message["CusORSell"] . ">" . $User . " : " . $Message["CoversaTion"] . $Message["MessageTime"] . "<div>" . $Message["Description"] . "</div>" ."</div>";
			}
		
	}
	else
	{

		$CreateTable = $conn->prepare("CREATE TABLE neg'. $SmallKey .'(Id INT AUTO_INCREMENT PRIMARY KEY NULL,CoversaTion VARCHAR(50) NULL,Description VARCHAR(200) NULL,MessageTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CusORSell VARCHAR(20) NULL);");
	
		if ($CreateTable->execute())
		{
				
		}
		else
		{
			echo " ";
		}
	}
	
	CloseCon($conn);
?>';

                        $filename = "../../Products/" ."$Productkey" .'/index.php';
                        $filename_1 = "../../Negotiation/Customer/" ."$SmallKey" . '/index.php';
                        $filename_2 = "../../Negotiation/Customer/" ."$SmallKey" . '/style.css';
                        $filename_3 = "../../Negotiation/Customer/" ."$SmallKey" . '/Getmessage.php';
                        createAndWriteToFile($filename, $phpFileContent);
                        createAndWriteToFile($filename_1, $phpFileContent_1);
                        createAndWriteToFile($filename_2, $phpFileContent_2);
                        createAndWriteToFile($filename_3, $phpFileContent_3);
                        $_SESSION['ProKey'] = $Productkey;
                        $_SESSION['ProName'] = $Productname;
                        echo "<script> location.href='UploadImage.php'; </script>"; 
                
                    } 
                    else 
                    {
                        echo "Failed to create directory!";
                    }
            } 
            else 
            {
                        function createAndWriteToFile($filename, $content) 
                        {
                        
                            $file = fopen($filename, 'w');
                        
                        
                            if ($file === false) {
                                die("Error: Unable to open file.");
                            }
                        
                        
                            fwrite($file,

                             $content);
                        
                        
                            fclose($file);
                        }
                        $Redirect = "<script> location.href='../../Negotiation/Customer'; </script>";
                        
                        $phpFileContent = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>'. $Productname . '</title>
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
                <center><h2 style="margin-top: 1.1em;margin-bottom: .5em;"><?php session_start();$username = $_SESSION["Fullname"];echo $username; ?></h2></center>
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
				<img src="../../Products/' . $Productkey .'/Image.jpg" height="500" width="600" alt="Product 1">
				<div class="Product_Details">
					<p class="Name_Pro">'. $Productname .'</p>
					<p class="Despcription_Pro">' . $ExtraDesp . '</p>
         	<p class="Price_Pro">₹' . $Productprice . '</p>
         	<input type="submit" name="AddtoCart" class="AddtoCart" value="Add to Cart">
         	<input type="submit" name="Negotiation" class="NegoBut" value="Negotiation">
        </div>
			</div>
		</div>
	</form>
</body>
</html>
<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST")
	{
		$Token = "Product123";
		if (isset($_POST["Negotiation"]))
		{
			$_SESSION["Token"] = $Token;
			setcookie("PriceError", " ");
			echo "' . $Redirect . '";
		}
		
	}
?>';                
                    
												$Para = "<p style='color: red;font-size: .7em;margin-left: 38em;'>Invalid</p>";
												$Meta = "<meta http-equiv='refresh' content='0; URL='>";
												$Ans1 = 'I Want this product for this price ₹$Message at ';
												$Ans2 = '$Description';
												$Ans3 = 'Cus';
												$SQL = "INSERT INTO neg$SmallKey(CoversaTion,Description,CusORSell) VALUES('" . $Ans1 . "', '" . $Ans2 . "', '" . $Ans3 . "');";
												$phpFileContent_1 = '<?php
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
				<input type="text" name="ProductName" class="ProductNameInp" value="'. $Productname .'" disabled>
			</div>
			<div>
				<label class="CurPrice">Current Price :</label>
				<input type="text" name="CurPrice" class="CurPriceInp" value="₹'. $Productprice .'" disabled>
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
				setcookie("PriceError", "' . $Para . '");
            	echo "' . $Meta . '";
			}
			else if ($Message === "0")
			{
				setcookie("PriceError", "' . $Para . '");
            	echo "' . $Meta . '";
			}
			else
			{
				$AddMessage = $conn->prepare("' . $SQL .'");
				if ($AddMessage->execute()) 
				{
						Email_Verification("suryasiva1130@gmail.com", "' . $ProductName . '", "' . $Productprice . '", "' . $Productkey . '" ,"$Message");
					echo "' . $Meta . '";
				}
				else
				{
					echo "Tryagain somthing want wrong.";
				}
			}
		}
		CloseCon($conn);
	}
?>';

												$phpFileContent_2 = '*{
	margin: 0;
	padding: 0;
	text-decoration: none;
}
body{
	display: flex;
	justify-content: center;
	align-items: center;
}
.container{
	max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    display: block;
}
.Topic{
	display: flex;
	justify-content: center;
	margin-bottom: 1em;
	font-size: 1.9em;
	font-weight: sold;
}
.ProductName{
	font-size: 1.1em;
	margin-right: 1em;
}
.ProductNameInp{
	padding: auto;
	border-radius: 5px;
	font-size: .9em;
}
.CurPrice{
	margin-top: 1.5em;
	font-size: 1.1em;
	margin-right: 1em;
}
.CurPriceInp{
	margin-top: 1.5em;
	border-radius: 5px;
	padding-left: 2px;
}
.NegoPrice{
	margin-top: 1.5em;
	font-size: 1.1em;
	margin-right: 1em;
	margin-left: 1em;
}
.NegoPriceInp{
	margin-top: 1.5em;
	border-radius: 5px;
	padding: 1px 0px 1px 4px;
	border: 1px solid black;
}
.DesBox{
	display: grid;
	grid-template-columns: 10em;
	margin-top: 1.5em;
}
.Descrip{
	font-size: 1em;
	margin-bottom: .5em;
}
.DescripBox{
	width: 44em;
	height: 10vh;
	padding: 5px;
}
.SubBox{
	display: flex;
	justify-content: center;
	align-items: center;
	margin-top: 1em;
}
.Sub{
	padding: 5px;
	font-size: .9em;
	border-radius: 5px;
	border: 1px solid black;
}
.MessText{
	font-size: 1.05em;
}
.Messages{
	margin-top: .5em;
	padding: 30px 30px 120px 30px;
	border: 1px solid black;
}';
												

												$SQL1 = "SELECT 1 FROM information_schema.tables WHERE table_schema = 'registerui' AND table_name = 'neg" . $SmallKey . "' LIMIT 1";
												$phpFileContent_3 = '<?php
	require "../../../Config/config.php";
	$conn = OpenCon();
	$tableName = "negf76e5aef6e";
	$A = "' . $SQL1 . '";
	$tableCheckResult = $conn->query($A);
	//$FindTableExist = $conn->query("SHOW TABLES LIKE $tableName");
	if ($tableCheckResult && $tableCheckResult->num_rows > 0) 
	{
			$GetTextMessage = mysqli_query($conn,"SELECT * FROM neg'. $SmallKey .';");
			while ($Message = mysqli_fetch_array($GetTextMessage))
			{
				if($Message["CusORSell"] === "Cus")
				{
					$User = "You";
				}
				else
				{
					$User = "Seller";
				}
			
				echo "<div class=" . $Message["CusORSell"] . ">" . $User . " : " . $Message["CoversaTion"] . $Message["MessageTime"] . "<div>" . $Message["Description"] . "</div>" ."</div>";
			}
		
	}
	else
	{

		$CreateTable = $conn->prepare("CREATE TABLE neg'. $SmallKey .'(Id INT AUTO_INCREMENT PRIMARY KEY NULL,CoversaTion VARCHAR(50) NULL,Description VARCHAR(200) NULL,MessageTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CusORSell VARCHAR(20) NULL);");
	
		if ($CreateTable->execute())
		{
			
		}
		else
		{
			echo " ";
		}
	}
	
	CloseCon($conn);
?>';

                				$filename = "../../Products/" ."$Productkey" .'/index.php';
                        $filename_1 = "../../Negotiation/Customer" ."$SmallKey" . '/index.php';
                        $filename_2 = "../../Negotiation/Customer" ."$SmallKey" . '/style.css';
                        $filename_3 = "../../Negotiation/Customer" ."$SmallKey" . '/Getmessage.php';
                        createAndWriteToFile($filename, $phpFileContent);
                        createAndWriteToFile($filename_1, $phpFileContent_1);
                        createAndWriteToFile($filename_2, $phpFileContent_2);
                        createAndWriteToFile($filename_3, $phpFileContent_3);
                        
                    
            }



					
					$_SESSION['ProKey'] = $Productkey;
					$_SESSION['ProName'] = $Productname;
					echo "<script> location.href='UploadImage.php'; </script>";	
				
									
				}
				else
				{
					echo "Tryagain";
				}
			
			
		

		}

		
		    
		CloseCon($conn);
	}
		?>

