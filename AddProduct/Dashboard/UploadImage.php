<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="container">
            <center><h2 class="Upload">Upload Image</h2></center>
            <input type="file" name="image" class="ImgInp" required>
            <center><input type="submit" name="submit" value="Upload" class="SubBox"></center>
        </div>
    </form>

    <?php
    session_start();
    require '../../Config/config.php';
    $conn = OpenCon();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $image = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];
        $Productkey = $_SESSION['ProKey'];
        $Productname = $_SESSION['ProName'];
        $Token = $_SESSION['Token'];

        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        if (in_array($image_type, $allowed_types)) 
        {

            $img_content = addslashes(file_get_contents($image));
            $sql = "UPDATE products SET ProductImage = '$img_content',ImageType = '$image_type' WHERE ProductKey = '$Productkey';";
            if ($conn->query($sql) === TRUE) 
            {

                $targetDir = "../../Products/" ."$Productkey" . "/";

                $originalName = basename($_FILES["image"]["name"]);

                $newName = "Image.jpg";

                $targetFile = $targetDir . $newName;

                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) 
                {

                    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) 
                    {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) 
                        {
                            $_SESSION['ProKey'] = " ";
                            header("Location: ../../Customer/Dashboard/?ID=" . urlencode($Token));
                            //echo "<script> location.href='../../Customer/Dashboard/'; </script>";
                        } 
                        else 
                        {
                            echo "Sorry, there was an error uploading your image.";
                        }
                    } 
                    else 
                    {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                } 
                else 
                {
                    echo "File is not an image.";
                }

            }
        }
    }


/*





$directory = "../../Products/" . "$Productname" ."$Productkey";

                if (!is_dir($directory))
                {
                
                    if (mkdir($directory, 0755, true)) 
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
                        
                        $phpFileContent = '<?php

?>';                
                    
                    
                        $filename = "../../Products/" . "$Productname" ."$Productkey" .'/index.php';
                        
                        createAndWriteToFile($filename, $phpFileContent);
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
                        
                        $phpFileContent = '<?php
        
?>';                
                    
                    
                        $filename = "../../Products/" . "$Productname" ."$Productkey" .'/index.php';
                        
                        createAndWriteToFile($filename, $phpFileContent);
                        
                    
            }






*/

    $conn->close();
    ?>
</body>
</html>
