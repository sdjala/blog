<?php  
include '../../utils/dbh.php';


 if(isset($_POST["comment_id"]))  
 {  
      $query = "SELECT * FROM comments WHERE id = '".$_POST["comment_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  else {echo 'No task id';}
 ?>