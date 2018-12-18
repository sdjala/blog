<?php

include '../../utils/dbh.php';

$user_id = $_POST['user_id'];
if (isset($_POST['done'])) {
	$query = "  
           UPDATE users   
           SET status = '1'         
           WHERE id='$user_id' ";
        
           $result = mysqli_query($connect, $query);

        }   

if (isset($_POST['undone'])) {
	$query = "  
           UPDATE users   
           SET status = '0'         
           WHERE id='$user_id'";
;
$result = mysqli_query($connect, $query);
}


if($result){
        echo "ok";
    }
    else{
        echo "err";
    }
?>



