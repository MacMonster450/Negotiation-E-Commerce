<?php
	require '../../Config/config.php';
	$conn = OpenCon();
	$GetId = $_GET['Key'];
	$Accepted = $conn->prepare("INSERT INTO $GetId(CoversaTion,Description,CusORSell) VALUES('Rejected ', ' ', 'Sell');");
	if($Accepted->execute())
	{
		echo "<center><h1>Submitted</h1></center>";
	}
	else
	{
		echo "Tryagain";
	}



	CloseCon($conn);

?>