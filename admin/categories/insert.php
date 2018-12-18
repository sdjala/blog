<?php  
include '../../utils/dbh.php';
session_start();
$sessionID=$_SESSION['id'];
//echo '<script>console.log('.json_encode($sessionID).')</script>';
$category_id = $_POST["category_id"];
if(!empty($_POST))
     try{  
     {  
          $output = '';  
          $message = '';  
          $name = test_input($_POST['name']);  
          $description = test_input($_POST['description']);   
          if($_POST["category_id"] != '')  
          {  
               $query = "  
               UPDATE categories   
               SET name = '$name',   
               description = '$description'       
               WHERE id='$category_id'";   
          }  
          else  
          {  
               $query = "  
               INSERT INTO categories(name, description)  
               VALUES('$name', '$description');  
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