<?php
include '../utils/dbh.php';
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     echo "err";
}else if(isset($_POST["comment_id"]))  
{    
	$query = "DELETE FROM comments WHERE id = '".$_POST["comment_id"]."'";
     $result = mysqli_query($connect, $query); 
     echo "ok";
     }
     else{
          echo "err";
     }   
 //echo '<script>console.log('.json_encode($_POST["task_id"]).')</script>';	
?>

    