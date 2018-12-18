<?php  
include '../../utils/dbh.php';
session_start();
$sessionID=$_SESSION['id'];
//echo '<script>console.log('.json_encode($sessionID).')</script>';
$user_id = $_POST["user_id"];
if(!empty($_POST))
     try{  
     {  
          $output = '';  
          $message = '';  
          $name = test_input($_POST['name']);  
          $email = test_input($_POST['email']); 
          $password = test_input($_POST['password']);     
          $role = test_input($_POST['role']);  
          $status = test_input($_POST['status']);   
          $estatus = test_input($_POST['estatus']);  

          $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
          
          if($_POST["user_id"] != '')  
          {  
               $query = "  
               UPDATE users   
               SET username = '$name',   
               email = '$email',      
               role_id = '$role',   
               status = '$status',     
               isEmailConfirmed = '$estatus'      
               WHERE id='$user_id'";   
          }  
          else  
          {  
               $query = "  
               INSERT INTO users(username, email, password, role_id, status, isEmailConfirmed)  
               VALUES('$name', '$email', '$hashedPassword', '$role', '$status', '$estatus');  
               ";  
          } 

          $result = mysqli_query($connect, $query);
          }
     }catch (Exception  $ex) {
          throw new Exception("No user ID \n" . $ex);
     }  
     
     function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
 ?>