



<?php
	require "PHPMailer-master/src/PHPMailer.php";
	require "PHPMailer-master/src/SMTP.php";
	require "PHPMailer-master/src/Exception.php";


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	
	//Load Composer's autoloader
	
	
	function Email_Verification($Email, $Firstname, $ProductActualPrice, $ProductID, $CustomerPrice, $NegoId)
	{

        $mail = new PHPMailer;
        $mail->SMTPDebug = 2;
       	$mail->isSMTP();
    	$mail->Host       = 'smtp.gmail.com';
    	$mail->SMTPAuth   = true;
    	$mail->SMTPSecure = 'tls';
    	$mail->Port       = 587;


        $mail->Username   = 'your_email_id';
        $mail->Password   = 'email_id_passkey';

		$mail->setFrom('your_email_id', 'your_company_name');
		$mail->addAddress($Email, $Firstname);

		$mail->isHTML(true);
		$mail->Subject = 'From Customer Request:';
		$mail->Body = "<p>Customer Want is product:<h4>ProductID :". $ProductID . "</h4><h4>Negotiation Id: " . $NegoId . "<?h4><h4>Product Actual Price : " . $ProductActualPrice . "</h4><h4>Customer Suggested Price: " . $CustomerPrice . "</h4><h4>You Accepte click this link: <br><a href='http://localhost/Hackathon/Negotiation/Seller/Verified.php?Key=" . $NegoId . "'>http://localhost/Hackathon/Negotiation/Seller/Verified.php?Key=" . $NegoId . "</a></h4><br><h4>Not Accepeted click this link : <br><a href= 'http://localhost/Hackathon/Negotiation/Seller/NotVerified.php?Key=" . $NegoId . "'>http://localhost/Hackathon/Negotiation/Seller/NotVerified.php?Key=" . $NegoId . "</a></h4>";
		$mail->send();
	}
?>