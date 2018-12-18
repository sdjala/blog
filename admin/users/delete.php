<?php
include '../../utils/dbh.php';

//echo '<script>console.log('.json_encode($_POST["task_id"]).')</script>';	
if(isset($_POST["user_id"]))  
{    echo "success";
	$query = "DELETE FROM users WHERE id = '".$_POST["user_id"]."'";
     $result = mysqli_query($connect, $query); 
    
}else{
     echo "err";
 }
    ?>