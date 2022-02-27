<?php

$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_connect.php';
    
    $user_name = $_POST['signupName'];
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupCpassword'];
    $avatar_code = substr($user_name, 0, 1);
    
    if(($avatar_code>='a' && $avatar_code<='z') || ($avatar_code>='A' && $avatar_code<='Z')){
        $ascii_val = ord($avatar_code);
        if($ascii_val<97){
            $ascii_val -= 64;
        }else{
            $ascii_val -= 96;
        }
    
        // check wheather user already exist
        $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email' OR user_name = '$user_name';";
        $result = mysqli_query($conn, $existSql);
        $numRows = mysqli_num_rows($result);
        if ($numRows > 0) {
            $showError = "Userexits";
        } else{ 
            if ($pass == $cpass) {  // 1. check both p/w are same or not
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`, `user_name`, `avatar_id`) VALUES ('$user_email', '$pass', CURRENT_TIMESTAMP, '$user_name', '$ascii_val')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                    header("Location: /omnix/index.php?success=true");
                    exit();
                }
            } else {
                $showError = "Passfail"; // 2. throw error if both the passwords are not same
            }
        }
    }
        header("Location:/index.php?success=false&error=$showError");
}

?>