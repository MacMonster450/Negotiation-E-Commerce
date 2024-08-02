<?php
function OpenCon()
{
 	$dbhost = "localhost";
 	$dbuser = "root";
 	$dbpass = "";
 	$db = "registerui";
 	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
 	if(!$conn)
 	{
 		die("Connect failed: ". mysqli_connect_error());
 	}
 	return $conn;
}
function TokenName()
{
	$_SESSION['Token'] = 'jkjmik#%&m&%^$&@?oo$&8495mii55%&^98mnRRcrt4#67MIiik';
}
function CloseCon($conn)
{
	$conn -> close();
}
?>