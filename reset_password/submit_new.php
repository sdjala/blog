<?php
include 'classes/user.php';

if(isset($_POST['email']) && $_POST['password'])
{
  $u = new User();
  $email=test_input($_POST['email']);
  $pass=test_input($_POST['password']);
  $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
  $u-> updatePwd($hashedPassword, $email);
   echo "ok";
}else {echo "err";}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
?>