<?php
  function redirect() {
    header('Location: login');
    exit();
  }

  if (!isset($_GET['email']) || !isset($_GET['token'])) {
    redirect();
  } else {

    $email = test_input($_GET['email']);

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
		<title>Reset Password</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php include '../includes/header1.php'; ?>

	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<form class="form-horizontal" id="pwd_form" method="post" action="submit_new" enctype="multipart/form-data">
                <p>Enter new password!</p>
					<div class="form-group">
							<label class="control-label col-sm-2" for="email">Password:</label>
						<div class="col-sm-10">
							<input class="form-control" type="password" name='password' id="password"  placeholder="Password..." required>
						</div>
					</div>
					<div class="form-group">
						<input class="btn btn-primary" id="submit" type="submit" name="submit" value="Submit" />
						</div>
				</form>
				<div id="message"></div>
			</div>
		</div>
	</div>
</body>
</html>

<script>
       $("#email_form").submit(function(event){
        event.preventDefault(); //prevent default action 
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = $(this).serialize(); //Encode form elements for submission
        
        $.ajax({
          url : post_url,
          type: request_method,
          data : form_data,
		  success:function(data){
                 $('#message').html(data);
        }
      });
	  });
</script>