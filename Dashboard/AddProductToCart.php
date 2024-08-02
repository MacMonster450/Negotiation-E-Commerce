<?php
require '../Config/config.php';

if (isset($_GET['AC']))
{
	$conn = OpenCon();
	$AddPassCode = $_GET['AC'];
	$checkAddValidCode=mysqli_query($conn,"SELECT * FROM users WHERE Token='$AddPassCode'");
	$checkAProws=mysqli_num_rows($checkAddValidCode);
	if ($checkAProws>0)
	{
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (isset($_POST['TopInsert']))
			{

				$scriptCode = $_POST['scriptCode'];
    			$marker = '// TopInsertAdditionalCodeHere';
    			$destinationFilePath = "../dashboard/index.php";
    			$existingContent = file_get_contents($destinationFilePath);
    			$markerPosition = strpos($existingContent, $marker);
    			
    			if ($markerPosition !== false) 
    			{
    			    $newContent = substr_replace($existingContent, PHP_EOL . "\n\t\t\t\t\t\t" .  "," .$scriptCode, $markerPosition + strlen($marker), 0);
    			    file_put_contents($destinationFilePath, $newContent);
    			    echo "<p style='display: flex;justify-content: center;align-items: center;text-align: center;padding: 10px 10px 10px 10px;background-color: lightgreen;'>Additional code has been added after the marker in the destination file.</p>";
    			} 
    			else 
    			{
    			    echo "<p style='display: flex;justify-content: center;align-items: center;text-align: center;padding: 10px 10px 10px 10px;background-color: #ff6969;'>Code was Not add please tryagain.</p>";

    			}
			}
		}
	}
	else
	{
		echo "<script> location.href='../'; </script>";
	}
	CloseCon($conn); 
    
}
else 
{
    echo "<script> location.href='../'; </script>";
}
?>