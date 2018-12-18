<?php
include 'classes/user.php';

	function redirect() {
		header('Location: register.php');
		exit();
	}

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	} else {

		$email = test_input($_GET['email']);
		$token = test_input($_GET['token']);

		$u = new User();
		$result = $u-> confirmUser($email, $token);

		if ($result) {
			echo 'Your email has been verified! You can log in now!';
		} else
			redirect();
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
?>