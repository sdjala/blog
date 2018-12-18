<?php
include '../utils/dbh.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
  require '../vendor/autoload.php';
  $output="";
if(isset($_POST['email']))
{
  $email=test_input($_POST['email']);
  $select=mysqli_query($connect, "SELECT email FROM users WHERE email='$email'");
  if(mysqli_num_rows($select)==1)
  {
    $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);

        $mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 2;
				$mail->Host = 'smtp.mailtrap.io';
				$mail->Port = 25;
				$mail->SMTPSecure = 'tls';
				$mail->SMTPAuth = true;
				$mail->Username = '2c9e6f176342e2';
				$mail->Password = 'c57d915802ea2c';
				$mail->FromName = "SoftAOX - PHP Mailer";
				$mail->setFrom('sokoldjala@gmail.com', 'Sokol Djala');
				$mail->addAddress($email);
				$mail->Subject = 'Please verify email!';
				$mail->Body = 'Please click on the link below:<br><br>
                    
				<a href="http://localhost/blog/reset_pass.php?email=$email&token=$token">Click Here</a>';
				$mail->send();
		
                if ($mail->send())
                    {echo "ok";} 
                else
                  {echo "err";}

                  echo $output;
  }else {echo "err";}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
?>