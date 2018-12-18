<?php
include '../../utils/dbh.php';

//echo '<script>console.log('.json_encode($_POST["task_id"]).')</script>';	
if(isset($_POST["article_id"]))  
{    
	$query = "DELETE FROM articles WHERE id = '".$_POST["article_id"]."'";
     $result = mysqli_query($connect, $query); 
     echo "success";
}else{
     echo "err";
 }
    ?>