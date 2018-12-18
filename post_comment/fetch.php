<?php  
include '../utils/dbh.php';

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     echo 'err';
}else {   $user_id = $_SESSION['id'];
          if(isset($_POST["comment_id"]))  
          {  
               $query = "SELECT * FROM comments WHERE id = '".$_POST["comment_id"]."'";  
               $result = mysqli_query($connect, $query); 
               $row = mysqli_fetch_array($result); 
               $uid=$row['uid'];
               if($user_id == $uid || $user_id == '1') { 
               echo json_encode($row); 
               } 
          }  else {echo 'No task id';}

     }
 ?>