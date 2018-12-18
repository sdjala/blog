<?php
include '../../utils/dbh.php';

//echo '<script>console.log('.json_encode($_POST["task_id"]).')</script>';	
if(isset($_POST["category_id"]))  
{    echo "success";
	$query = "DELETE FROM categories WHERE id = '".$_POST["category_id"]."'";
     $result = mysqli_query($connect, $query); 
     echo "success";
}else{
     echo "err";
 }
    ?>