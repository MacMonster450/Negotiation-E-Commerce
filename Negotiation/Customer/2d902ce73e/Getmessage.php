<?php
	require "../../../Config/config.php";
	require "../../Emailsender.php";
	$conn = OpenCon();
	$tableName = "negf76e5aef6e";
	$A = "SELECT 1 FROM information_schema.tables WHERE table_schema = 'registerui' AND table_name = 'neg2d902ce73e' LIMIT 1";
	$tableCheckResult = $conn->query($A);
	//$FindTableExist = $conn->query("SHOW TABLES LIKE $tableName");
	if ($tableCheckResult && $tableCheckResult->num_rows > 0) 
	{
			$GetTextMessage = mysqli_query($conn,"SELECT * FROM neg2d902ce73e;");
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

		$CreateTable = $conn->prepare("CREATE TABLE neg2d902ce73e(Id INT AUTO_INCREMENT PRIMARY KEY NULL,CoversaTion VARCHAR(50) NULL,Description VARCHAR(200) NULL,MessageTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CusORSell VARCHAR(20) NULL);");
	
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