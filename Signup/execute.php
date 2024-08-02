<?php
    require_once "../Config/config.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $conn = OpenCon();
        $Email=$_POST['EmailId'];
        $FullName=$_POST['FullName'];
        $MobileNumber=$_POST['MobileNumber'];
        $Cus_Or_Sel=$_POST['Cus_or_Sel'];
        $Password=$_POST['PassWord'];
        $hashedPassWord = password_hash($Password, PASSWORD_BCRYPT);
        if ($Cus_Or_Sel === 'customers') 
        {
            $CusOrSel = "Customer";
        }
        else
        {
            $CusOrSel = "Seller";
        }
        echo $Cus_Or_Sel;
        
        CloseCon($conn);
    }
?>