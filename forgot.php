<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'mini') or die('Error connecting to MySQL server.');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mailto = $_POST["email"];

if(isset($_POST['email'])){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $check_email = "SELECT * FROM minproject WHERE Email='$email'";
  $run_sql = mysqli_query($con, $check_email);
  if(mysqli_num_rows($run_sql) > 0){
    $code = rand(999999, 111111);
    $insert_code = "UPDATE minproject SET code = $code WHERE Email = '$email'";
    $run_query =  mysqli_query($con, $insert_code);
    if($run_query){
      $mail->isSMTP();											
      $mail->Host	 = 'ssl://smtp.gmail.com';					
      $mail->SMTPAuth = true;							
      $mail->Username = 'aditya.tayade@somaiya.edu';				
      $mail->Password = "ypwnqmaqilvgzxtc";						
      $mail->SMTPSecure = 'tls';							
      $mail->Port	 = 465;

      $mail->setFrom('aditya.tayade@somaiya.edu', 'Reset Your Password');		
      $mail->addAddress($mailto);
      
      $mail->isHTML(true);								
      $mail->Subject = 'Newsboy - Reset your Password';
      $mail->Body = "Your Password reset code is $code";
      $mail->send();
      // echo "Mail has been sent successfully!";
      header('location: reset.php');
          exit();
      }else{
          echo "Failed while sending code!";
      }
    }else{
      echo "Something went wrong!";
  }
}else{
  echo "This email address does not exist!";
}


?>



