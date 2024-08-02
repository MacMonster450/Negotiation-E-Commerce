<?php
	require '../../Config/config.php';
	$conn = OpenCon();
	$tableName = "negotiation";
	$checkTNSell  = "SELECT Token FROM customer WHERE EmailID='$Email'";
    $ckeckTNrows = mysqli_query($conn, $checkTNSell);
    while($Tokenrow = mysqli_fetch_array($ckeckTNrows)) 
    {
        $CheckSell = $Tokenrow['Token'];
    }
	$FindTableExist = $conn->query("SHOW TABLES LIKE '$tableName'");
	if ($FindTableExist->num_rows > 0) 
	{
			$GetTextMessage = mysqli_query($conn,"SELECT * FROM negotiation;");
			while ($Message = mysqli_fetch_array($GetTextMessage))
			{
				if($Message['CusORSell'] === 'Cus')
				{
					$User = "You";
				}
				else
				{
					$User = "Seller";
				}
			
				echo "<div class=" . $Message['CusORSell'] . ">" . $User . " : " . $Message['CoversaTion'] . $Message['MessageTime'] . "<div>" . $Message['Description'] . "</div>" ."</div>";
			}
		
	}
	else
	{

		$CreateTable = $conn->prepare("CREATE TABLE negotiation(Id INT AUTO_INCREMENT PRIMARY KEY NULL,CoversaTion VARCHAR(50) NULL,Description VARCHAR(200) NULL,MessageTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CusORSell VARCHAR(20) NULL);");
	
		if ($CreateTable->execute())
		{
	
		}
		else
		{
			echo " ";
		}
	}
	
	CloseCon($conn);
?>