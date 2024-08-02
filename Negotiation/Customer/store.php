<?php
require '../../Config/config.php';
	function CreateTable()
	{
		$conn = OpenCon();
		$CreateTable = $conn->prepare("CREATE TABLE negotiation(Id INT AUTO_INCREMENT PRIMARY KEY NULL,CoversaTion VARCHAR(50) NULL);");
		if ($CreateTable->execute())
		{
			echo "Done";
			StoreUMess($TextFromUser);
			
		}
		else
		{
			echo "No";
			StoreUMess($TextFromUser);
		}
		CloseCon($conn);
	}
?>