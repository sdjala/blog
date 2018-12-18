<?php  
include '../../utils/dbh.php';


 if(isset($_POST["user_id"]))  
 {  
      $query = "SELECT * FROM users WHERE id = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  else {echo 'No task id';}
 ?>