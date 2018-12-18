<?php  
include '../../utils/dbh.php';


 if(isset($_POST["category_id"]))  
 {  
      $query = "SELECT * FROM categories WHERE id = '".$_POST["category_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  else {echo 'No task id';}
 ?>