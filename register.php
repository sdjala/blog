<?php
	include 'classes/user.php';

	$msg = "";
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';

	$username=$email=$password=$cPassword="";

	if (isset($_POST['submit'])) {
		$u = new User();
		
		$username = test_input($_POST['username']);
		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);
		$cPassword = test_input($_POST['cPassword']);

		if ($password != $cPassword){
			$msg = "Your password don't match!";
		}else if (strlen($_POST["password"]) <= '6') {
			$msg = "Your Password Must Contain At Least 6 Characters!";
		}
		elseif(!preg_match("#[0-9]+#",$password)) {
			$msg = "Your Password Must Contain At Least 1 Number!";
		}
		elseif(!preg_match("#[A-Z]+#",$password)) {
			$msg = "Your Password Must Contain At Least 1 Capital Letter!";
		}
		elseif(!preg_match("#[a-z]+#",$password)) {
			$msg = "Your Password Must Contain At Least 1 Lowercase Letter!";
		}
		else {
			$sql = $u-> checkUser($email);
			if ($sql->num_rows > 0) {
				$msg = "Email already exists in the database!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

				$u-> addUser($username, $email, $hashedPassword, $token);

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
                    
				<a href="http://localhost/blog/confirm.php?email=$email&token=$token">Click Here</a>';
				$mail->send();
		
                if ($mail->send())
                    $msg = "You have been registered! Please verify your email!";
                else
                    $msg = "Something wrong happened! Please try again!";
			}
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
	  
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Register</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php include 'includes/header1.php'; ?>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">

				<?php if ($msg != "") echo $msg . "<br><br>" ?>

				<form class="form-horizontal" method="post" action="register.php">
					<div class="form-group">
							<label class="control-label col-sm-2" for="username">Username:</label>
						<div class="col-sm-10">
							<input class="form-control" name="username" placeholder="Username..." required>
						</div>
					</div>
					<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email:</label>
						<div class="col-sm-10">
							<input class="form-control" name="email" type="email" placeholder="Email..." required>
						</div>
					</div>
					<div class="form-group">
							<label class="control-label col-sm-2" for="password">Password:</label>
						<div class="col-sm-10">
							<input class="form-control" name="password" type="password" placeholder="Password..." required>
						</div>
					</div>
					<div class="form-group">
							<label class="control-label col-sm-2" for="cPassword">Confirm Password:</label>
						<div class="col-sm-10">
							<input class="form-control" name="cPassword" type="password" placeholder="Confirm Password..." required>
						</div>
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" name="submit" value="Register">
						</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>