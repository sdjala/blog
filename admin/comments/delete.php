<?php
include '../../utils/dbh.php';

//echo '<script>console.log('.json_encode($_POST["task_id"]).')</script>';	
if(isset($_POST["comment_id"]))  
{    echo "success";
	$query = "DELETE FROM comments WHERE id = '".$_POST["comment_id"]."'";
     $result = mysqli_query($connect, $query); 
    
}else{
     echo "err";
 }
    ?>