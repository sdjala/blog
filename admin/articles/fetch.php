<?php  
include '../../utils/dbh.php';


 if(isset($_POST["article_id"]))  
 {  
      $query = "SELECT * FROM articles WHERE id = '".$_POST["article_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  else {echo 'No article id';}
 ?>