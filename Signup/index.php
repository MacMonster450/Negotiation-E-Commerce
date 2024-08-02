<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
    <form class="container" method="POST">
        <div class="form-container">
            <div id="login-form" method="POST" class="Signup-form">
                <h2>Sign up</h2>
                <input type="email" id="login-email" name="EmailId" placeholder="Email" class="signup-input" autocomplete="off">
                <?php $UserError=$_SESSION['EmailError'];echo $UserError; ?>
                <input type="text" id="login-username" name="FullName" placeholder="Full Name" class="signup-input" autocomplete="off">
                <?php $UserError=$_SESSION['NameError'];echo $UserError; ?>
                <input type="number" id="login-username" name="MobileNumber" placeholder="Mobile number" minlength="10" maxlength="10" class="signup-input">
                <?php $UserError=$_SESSION['MobileError'];echo $UserError; ?>
                <div style="padding-left: ;">
                    <input type="password" id="login-password" name="PassWord" placeholder="Password" name="PassWord" class="signup-input" autocomplete="current-password" required="">
                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                </div><!--
                <div class="CusOrSel">
                    <p><input type="checkbox" onclick="Customer()" id="customers">Customer</p>
                    <p><input type="checkbox" onclick="Seller()" id="sellers" class="sel">Seller</p>
                </div>-->
                <div>
                    <center><input type="submit" name="Submit" value="Sign up" class="Signup" id="Submit"></center>
                </div>
                <center><p>Or</p></center>
                <center><p class="Signup-p">Don't have an account?<a href="../Signin" class="Signup-a"> Sign in</a></p></center>
            </div>
        </div>
        <div>
            
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
    </script><!--
    <script>
        function Customer() {
            var toggleCheckbox = document.getElementById("customers");
            var paragraph = document.getElementById("sellers");

            toggleCheckbox.addEventListener("change", function() {
                paragraph.contentEditable = toggleCheckbox.checked;
                paragraph.disabled = toggleCheckbox.checked;
                toggleCheckbox.setAttribute('value', 'customer');
                toggleCheckbox.setAttribute('name', 'customer');
            });
        }
        function Seller() {
            var toggleCheckbox = document.getElementById("sellers");
            var paragraph = document.getElementById("customers");

            toggleCheckbox.addEventListener("change", function() {
                paragraph.contentEditable = toggleCheckbox.checked;
                paragraph.disabled = toggleCheckbox.checked;
                toggleCheckbox.setAttribute('value', 'seller');
                toggleCheckbox.setAttribute('name', 'customer');
            });
        }
    </script>-->
    <script src="script.js"></script>
</body>
</html>
<?php
    require_once "../Config/config.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $conn = OpenCon();
        $Email=$_POST['EmailId'];
        $FullName=$_POST['FullName'];
        $MobileNumber=$_POST['MobileNumber'];
        $Password=$_POST['PassWord'];
        $hashedPassWord = password_hash($Password, PASSWORD_BCRYPT);
        $Token = substr(md5(mt_rand()), 0, 70);
        /*if ($_POST['customer'] === 'customer') 
        {
            $CusOrSel = "Customer";
        }
        else
        {
            $CusOrSel = "Seller";
        }*/


        if (empty($_POST['EmailId']) and empty($_POST['FullName'])) 
        {
            setcookie("EmailError", "<p style='color: red;font-size: .7em;'>Empty</p>");
            setcookie("NameError", "<p style='color: red;font-size: .7em;'>Empty</p>");
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }
        else if(empty($_POST['EmailId']))
        {
            setcookie("EmailError", "<p style='color: red;font-size: .7em;'>Empty</p>");
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }
        else if(empty($_POST['FullName']))
        {
            setcookie("NameError", "<p style='color: red;font-size: .7em;'>Empty</p>");
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }
        $checkEmailid=mysqli_query($conn,"SELECT * FROM customer WHERE EmailID='$Email'");
        $checkMobileNumberid=mysqli_query($conn,"SELECT * FROM customer WHERE MobileNumber='$MobileNumber'");
        $checkErows=mysqli_num_rows($checkEmailid);
        $checkMrows=mysqli_num_rows($checkMobileNumberid);
        if ($checkErows > 0) 
        {
            setcookie("EmailError", "<p style='color: red;font-size: .7em;'>Already Sign in.</p>");
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }
        else if ($checkMrows > 0) 
        {
            setcookie("MobileError", "<p style='color: red;font-size: .7em;'>Already Haved.</p>");
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }
        else if(strlen($MobileNumber < 10))
        {
            setcookie("MobileError", "<p style='color: red;font-size: .7em;'>Worrg number.</p>");
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        }
        else
        {

            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }
            $stmt = $conn->prepare("INSERT INTO customer (EmailID, FullName, PassWord, CusOrSel, MobileNumber, TokeN) VALUES ('$Email', '$FullName', '$hashedPassWord', 'Customer', '$MobileNumber', '$Token')");
            if ($stmt->execute()) 
            {
                
                    $_SESSION['Fullname'] = $FullName;
                    echo "<script> location.href='../Customer/Dashboard'; </script>";
            
            } 
            else 
            {
                echo "Error: " . $stmt->error;
            }
        }
            
            CloseCon($conn);
        }
?>