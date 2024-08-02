<?php
	require '../../Config/config.php';
	$conn = OpenCon();
	function AddGSTNum($GSTNum,$Emailid)
	{
		$InsertGST = $conn->prepare("UPDATE customer SET GSTINNumbeR='$GSTNum' WHERE EmailID='$Emailid';");
		if($InsertGST->execute())
		{
			echo "KK";
		}
		else
		{
			echo "oo";
		}
	}
	CloseCon($conn);
?>