<?php
session_start();
$_SESSION['EmailError'] = " ";
$_SESSION['PassError'] = " ";
?>
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
            <li><a href="../Signin" class="signin">Sign in</a></li>
            <li><a href="../Cart/Dashboard/" class="cart"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
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
            require '../Config/config.php';
            
            $conn = OpenCon();
            $GetTextMessage = mysqli_query($conn,"SELECT * FROM products;");
            while ($Message = mysqli_fetch_array($GetTextMessage))
            {
                $blob_data = $Message['ProductImage'];

        
                echo " <section class='product'>
                        <a href= ../Products/" . $Message['ProductName'] . $Message['ProductKey'] . "><img src='data:image/jpeg;base64,".base64_encode($blob_data)."' height='100' width='100'/></a>
                        <h2>" . $Message['ProductName']. "</h2>
                        <center><p class='Para'>" . $Message['ProductDescription'] . "</p></center><br>
                        <p>₹".$Message['ProductPrice']."</p>
                        <input type='submit' name='".$Message['ProductKey']."' class='AddtoCart' value='Add to Cart'>
                        </section>";

                    
                        if (isset($_POST[$Message['ProductKey']]))
                        {

                            $scriptCode = '<section class="product">
                                <a href = ' . $Message['ProductName'] . '><img src="data:image/jpeg;base64,'.base64_encode($blob_data).'" height="100" width="100"/></a>
                                <h2>' . $Message['ProductName']. '</h2>
                                <p>' .$Message['ProductDescription'].'</p><br>
                                <p>₹'.$Message['ProductPrice'].'</p>
                                <input type="submit" name="AddtoCart" class="AddtoCart" value="Add to Cart">
                            </section>';
                            $marker = "<!-- TopInsertAdditionalCodeHere -->";
                            $destinationFilePath = "../Cart/Dashboard/index.php";
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
