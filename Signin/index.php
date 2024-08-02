<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
    <form method="POST" class="container">
        <div class="form-container">
            <div id="login-form" class="Signin-form">
                <center><h2>Sign in</h2></center>
                <input type="email" id="login-email" placeholder="Email" name="EmailID" class="signin-input">
                <?php $Usererror = $_SESSION['EmailError'];echo $Usererror; ?>
                <div >
                    <input type="password" id="login-password" name="password" placeholder="Password" class="signin-input" autocomplete="current-password" required="">
                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                    <?php $Passerror = $_SESSION['PassError'];echo $Passerror; ?>
                </div>
                <center>
                    <input type="submit" name="Submit" value="Sign in" class="Signin">
                </center>
                <center><p>Or</p></center>
                <center><p class="Signin-p">Don't have an account?<a href="../Signup" class="Signin-a"> Sign up</a></p></center>
                
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
    <script src="script.js"></script>
</body>
</html>
<?php
      require_once "../Config/config.php";
      if ($_SERVER['REQUEST_METHOD'] === 'POST') 
      {

        $conn = OpenCon();
        $EmailId = $_POST['EmailID'];
        $PassWordID=$_POST['password'];
        $hashedPassWord = password_hash($PassWordID, PASSWORD_BCRYPT);
        $GetEmailid  = "SELECT CusOrSel FROM customer WHERE EmailID='$EmailId'";
        $GetEmailValueid = mysqli_query($conn, "SELECT CusOrSel FROM customer WHERE EmailID='$EmailId'");
        $GetUsername  = "SELECT FullName FROM customer WHERE EmailID='$EmailId'";
        $GetedUsername = mysqli_query($conn, $GetUsername);
        while($Search = mysqli_fetch_array($GetedUsername)) {
            $UsernameId = $Search['FullName'];
        }
        $checkTNSell  = "SELECT SmallToken FROM customer WHERE EmailID='$EmailId'";
        $ckeckTNrows = mysqli_query($conn, $checkTNSell);
        while($Tokenrow = mysqli_fetch_array($ckeckTNrows)) 
        {
            $GetToken = $Tokenrow['SmallToken'];
        }
        $_SESSION['Fullname'] = $UsernameId;
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $User = $conn->prepare("SELECT PassWord FROM customer WHERE EmailID='$EmailId'");
        $User->execute();
        $User->bind_result($hashedPassWordID);
        $User->fetch();
        
    
        if (password_verify($PassWordID, $hashedPassWordID))
        {
           while($row_1 = mysqli_fetch_array($GetEmailValueid))
           {
               $Cus_Or_Sel = $row_1['CusOrSel'];
           }
           if ($Cus_Or_Sel === 'Customer')
           {
                header("Location: ../Customer/Dashboard/?ID=" . urlencode($GetToken));
                //echo "<script> location.href='../Customer/Dashboard/'; </script>";
           }
           else if($Cus_Or_Sel === 'Seller')
           {
                header("Location: ../Seller/Dashboard/?ID=" . urlencode($GetToken));
                //echo "<script> location.href='../Seller/Dashboard/'; </script>";
           }
        }
        else
        {
           $_SESSION['EmailError'] = "<p style='color: red;font-size: .7em;'>Empty</p>";
           $_SESSION['PassError'] = "<p style='color: red;font-size: .7em;'>Empty</p>";
           echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }



        CloseCon($conn);
      }

?>