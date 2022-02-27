<?php
$showError = "false";
include '_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * FROM `users` WHERE user_email = '" . $user . "' OR user_name = '" . $user . "'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['user_pass']){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['user_name'];
            $_SESSION['userid'] = $row['sno'];
            $_SESSION['avtid'] = $row['avatar_id'];
            header("Location: /omnix/index.php?success=loggedin");
        } else {
            header("Location: /omnix/index.php?success=failpass");
        }
    }else{
        header("Location: /omnix/index.php?success=usernotfound");
    }
}
