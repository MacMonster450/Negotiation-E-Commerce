<?php
    session_start();
    $_SESSION['EmailError'] = " ";
    $_SESSION['PassError'] = " ";
    $_SESSION['EmailError'] = " ";
    $_SESSION['MobileError'] = " ";
    $_SESSION['NameError'] = " ";
    $_SESSION['InfoError'] = " ";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Default user To Sellor</title>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
	<form method="POST" class="container">
        <div class="form-container">
            <div id="login-form" class="Signin-form">
                <center><h2>Covert To Seller</h2></center>
                <input type="email" id="login-email" placeholder="Email" name="EmailID" class="signin-input">
                <?php $UserError=$_SESSION['EmailError'];echo $UserError; ?>
                <input type="text" id="login-email" placeholder="GSTIN Number" name="GSTINNumber" class="signin-input">
                <?php $UserError=$_SESSION['NameError'];echo $UserError; ?>
                <div >
                    <input type="password" id="login-password" name="password" placeholder="Password" class="signin-input" autocomplete="current-password" required="">
                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                    <?php $PassError=$_SESSION['PassError'];echo $PassError; ?>
                    <?php $InfoError=$_SESSION['InfoError'];echo $InfoError; ?>
                </div>
                <center>
                    <input type="submit" name="Submit" value="Sign in" class="Signin">
                </center>
            </div>
        </div>
    </form>
     <script type="text/javascript">
        const togglePassword = document.querySelector('#togglePassword');
          const password = document.querySelector('#login-password');
        
          togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
<?php
	require '../../Config/config.php';
	require 'Check_GSTIN.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $conn = OpenCon();
        $Email=$_POST['EmailID'];
        $GsTNumber=$_POST['GSTINNumber'];
        $Password=$_POST['password'];
        $hashedPassWord = password_hash($Password, PASSWORD_BCRYPT);
        $checkTNSell  = "SELECT TokeN FROM customer WHERE EmailID='$Email'";
        $ckeckTNrows = mysqli_query($conn, $checkTNSell);
        while($Tokenrow = mysqli_fetch_array($ckeckTNrows)) 
        {
            $GetToken = $Tokenrow['TokeN'];
        }
        function AddGSTNum($GSTNum,$Emailid)
        {
            $conn = OpenCon();
            $InsertGST = $conn->prepare("UPDATE customer SET GSTINNumbeR='$GSTNum' WHERE EmailID='$Emailid';");
            $InsertSell = $conn->prepare("UPDATE customer SET CusOrSel='Seller' WHERE EmailID='$Emailid';");
            if($InsertGST->execute() && $InsertSell->execute())
            {  
                header("Location: ../../Seller/Dashboard/?ID=" . urlencode($GetToken));
                //echo "<script> location.href='../../Seller/Dashboard/'; </script>";
            }
            else
            {
                $_SESSION['InfoError'] = "<p style='color: red;font-size: .7em;'>Tryagin something gone wrong</p>";
            }
            CloseCon($conn);
        }
        if (empty($_POST['EmailID']) and empty($_POST['GSTINNumber'])) 
        {
            $_SESSION['EmailError'] = "<p style='color: red;font-size: .7em;'>Empty</p>";
            $_SESSION['NameError'] = "<p style='color: red;font-size: .7em;'>Empty</p>";
            echo '<meta http-equiv="refresh" content="0; URL=">';
        }
        else if(empty($_POST['EmailID']))
        {
            $_SESSION['NameError'] = "<p style='color: red;font-size: .7em;'>Empty</p>";
            echo '<meta http-equiv="refresh" content="0; URL=">';
        }
        else if(empty($_POST['GSTINNumber']))
        {
            $_SESSION['NameError'] = "<p style='color: red;font-size: .7em;'>Empty</p>";
            echo '<meta http-equiv="refresh" content="0; URL=">';
        }
        $checkEmailid=mysqli_query($conn,"SELECT * FROM customer WHERE EmailID='$Email'");
        $checkItSell  = "SELECT CusOrSel FROM customer WHERE EmailID='$Email'";
        $ckeckCSrows = mysqli_query($conn, $checkItSell);
        while($Sellrow = mysqli_fetch_array($ckeckCSrows)) {
            $CheckSell = $Sellrow['CusOrSel'];
        }
        $checkErows=mysqli_num_rows($checkEmailid);
        if ($checkErows > 0) 
        {
            
            $User = $conn->prepare("SELECT PassWord FROM customer WHERE EmailID='$Email'");
            $User->execute();
            $User->bind_result($hashedPassWordID);
            $User->fetch();

            if (password_verify($Password, $hashedPassWordID)) 
            {
                if (isValidGSTIN($GsTNumber)) 
                {
                    if($CheckSell === "Seller")
                    {
                        header("Location: ../../Seller/Dashboard/?ID=" . urlencode($GetToken));
                        //echo "<script> location.href='../../Seller/Dashboard/'; </script>";
                    }
                    else
                    {
                        AddGSTNum($GsTNumber,$Email);
                    }
                } 
                else 
                {
                    $_SESSION['InfoError'] = "<p style='color: red;font-size: .7em;'>Invalid GSTIN!</p>";
                }
            }
            else
            {
                $_SESSION['NameError'] = "<p style='color: red;font-size: .7em;'>Wrong</p>";
                $_SESSION['NameError'] = "<p style='color: red;font-size: .7em;'>Wrong</p>";
                echo '<meta http-equiv="refresh" content="0; URL=">';
            }
            
        }
        else
        {
            $_SESSION['EmailError'] = "<p style='color: red;font-size: .7em;'>Invalid</p>";
            $_SESSION['NameError'] = "<p style='color: red;font-size: .7em;'>Invalid</p>";
            echo '<meta http-equiv="refresh" content="0; URL=">';
        }
        CloseCon($conn);

    }

?>