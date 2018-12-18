<?php  
include '../../utils/dbh.php';
session_start();
$sessionID=$_SESSION['id'];
//echo '<script>console.log('.json_encode($sessionID).')</script>';
$comment_id = $_POST["comment_id"];
$date = date('Y-m-d H:i:s');
if(!empty($_POST))
     try{  
     {  
          $output = '';  
          $message = '';  
          $comment = test_input($_POST['comment']);  
          
          if($_POST["comment_id"] != '')  
          {  
               $query = "  
               UPDATE comments   
               SET comment = '$comment',
               updated_at = '$date'   
               WHERE id='$comment_id'";   
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