<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Hawk</title>
    </script>
</head>
<body>
	<nav class="N1">
		<label class="logo">Hawk</label>
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="../../Cart/Dashboard/Customer" class="cart"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
            <li><input type="submit" onclick="openForm()" value ="Profile" style="background-color:rgb(53, 51, 52);color: white;font-style: Arial;border: none;font-size: 1em;cursor: pointer;"></li>
            <div class="form-popup" id="myForm">
              <form method="post" class="form-container" style="margin: .8em;">
                <input type="submit" onclick="closeForm()" value="Close" style=";float: right;color: red;background-color: white; font-style: Arial;border: none;font-size: 1em;cursor: pointer;margin-bottom: 1em;position: absolute;">
                <center><h2 style="margin-top: 1.1em;margin-bottom: 1em;"><?php session_start();$username = $_SESSION['Fullname'];echo $username; ?></h2></center>
                <a href="../../User/Dashboard/" style="color: black;border: 1px black solid;margin-top: 1em;box-shadow: 1px 2px 10px 1px;">Change To Seller Account</a>
              </form>
            </div>
            <script type="text/javascript">
                function openForm() 
                {
                    document.getElementById("myForm").style.display = "block";
                }

  // Function to close the popup form
                function closeForm() 
                {
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
	<main class="Products" id="Products">
        <?php
            require '../../Config/config.php';
            
            $conn = OpenCon();
            $GetTextMessage = mysqli_query($conn,"SELECT * FROM products;");
            $_SESSION['Token'] = $_GET['ID'];
            while ($Message = mysqli_fetch_array($GetTextMessage))
            {
                $blob_data = $Message['ProductImage'];

        
                echo " <section class='product'>
                        <a href= ../../Products/" . $Message['ProductKey'] . "><img src='data:image/jpeg;base64,".base64_encode($blob_data)."' height='100' width='100'/></a>
                        <h2>" . $Message['ProductName']. "</h2>
                        <center><p class='Para'>" . $Message['ProductDescription'] . "</p></center><br>
                        <p>₹".$Message['ProductPrice']."</p>
                        <input type='submit' name='".$Message['ProductKey']."' class='AddtoCart' value='Add to Cart'>
                        </section>";

                    
                        if (isset($_POST[$Message['ProductKey']]))
                        {

                            $scriptCode = '<section class="product">
                                <a href= ' . "../../" . $Message['ProductName'] . '><img src="data:image/jpeg;base64,'.base64_encode($blob_data).'" height="100" width="100"/></a>
                                <h2>' . $Message['ProductName']. '</h2>
                                <p>' .$Message['ProductDescription'].'</p><br>
                                <p>₹'.$Message['ProductPrice'].'</p>
                                <input type="submit" name="AddtoCart" class="AddtoCart" value="Add to Cart">
                            </section>';
                            $marker = "<!-- TopInsertAdditionalCodeHere -->";
                            $destinationFilePath = "../../Cart/Dashboard/Customer/index.php";
                            $existingContent = file_get_contents($destinationFilePath);
                            $markerPosition = strpos($existingContent, $marker);
                            if ($markerPosition !== false) 
                            {
                                $newContent = substr_replace($existingContent, PHP_EOL . "\n"  .$scriptCode, $markerPosition + strlen($marker), 0);
                                file_put_contents($destinationFilePath, $newContent);
                            } 
                            else 
                            {
                                echo "<p style='display: flex;justify-content: center;align-items: center;text-align: center;padding: 10px 10px 10px 10px;background-color: #ff6969;'>Code was Not add please tryagain.</p>";
                            }
                        }
                    }
            
            CloseCon($conn);
            
        ?>
    </main>
    </form>
	<script type="text/javascript" src="script.js">
    
    </script>
</body>
</html>
