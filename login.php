<?php
include 'classes/user.php';

	// Initialize the session
	session_start();	
		// Check if the user is already logged in, if yes then redirect him to home page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role'])){
		$role = $_SESSION['role'];
		if($role=="1"){header("location: admin/home");}
 			elseif($role=="2"){header("location: admin/article-list");}
 				elseif($role=="3"){header("location: /blog");}
		}

	$msg = "";

	if (isset($_POST['submit'])) {

		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);

		if ($email == "" || $password == "")
			$msg = "Please check your inputs!";
		else {
			$u = new User();
			$data = $u-> login($email, $password);
			$user=mysqli_fetch_array($data);
				$verify = password_verify($password, $user['password']);
                if ($verify) {
                    if ($user['isEmailConfirmed'] == 0)
	                    $msg = "Please verify your email!";
                    else {
						// $msg = "You have been logged in";
					   	// Password is correct, so start a new session
						if(!empty($_POST["remember"]))   
						{  
							setcookie ("member_login",$email,time()+ (10 * 365 * 24 * 60 * 60));  
							setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));	
						}else  
							{  
								if(isset($_COOKIE["member_login"]))   
								{  
								setcookie ("member_login","");  
								}  
								if(isset($_COOKIE["member_password"]))   
								{  
								setcookie ("member_password","");  
								}  
							}
							                             
						session_start();     
						// Store data in session variables
						$_SESSION["loggedin"] = true;
						$_SESSION["id"] = $user['id'];
						$_SESSION["username"] = $user['username'];
						$_SESSION['role'] = $user['role_id'];
						$role = $_SESSION['role'];

						if($role=="1"){header("location: admin/home");}
 							elseif($role=="2"){header("location: admin/article-list");}
 								elseif($role=="3"){header('Location: ' . $_SERVER['HTTP_REFERER']);}

					   	// Redirect user to welcome page
					   	//header("location: admin/home.php");
                    }
               
			} else {
				$msg = "Please check your inputs!";
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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>
		<?php include 'includes/header1.php'; ?>

		<div class="container" style="margin-top: 100px;">
			<div class="row justify-content-center">
				<div class="col-md-6 col-md-offset-3" align="center">

					<!-- <img src="images/logo.png"><br><br> -->

					<?php if ($msg != "") echo $msg . "<br><br>" ?>

					<form class="form-horizontal" method="post" action="login.php">
						<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email:</label>
							<div class="col-sm-10">
								<input class="form-control" name="email" type="email" placeholder="Email..." required value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
							</div>
						</div>
						<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password:</label>
							<div class="col-sm-10">
								<input class="form-control" name="password" type="password" placeholder="Password..." pattern=".{6,}" required value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-7">  
								<input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
								<label for="remember-me">Remember me</label> 
							</div> 
						</div>  
						<div class="form-group">
							<input class="btn btn-primary" type="submit" name="submit" value="Log In">
						</div>
						<a href="send-reset-link">Forgot Password</a> 
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
