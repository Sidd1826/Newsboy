<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'mini');

if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_DEFAULT);
        $update_pass = "UPDATE minproject SET code = 0, Pass = '$encpass' WHERE Email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if($run_query){
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            echo "Your password changed. Now you can login with your new password.";
            session_destroy();
            header('Location: http://localhost/mini-project/login/index.php');
        }else{
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

?>