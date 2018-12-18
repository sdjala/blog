<?php

include '../../utils/dbh.php';

$comment_id = $_POST['comment_id'];
if (isset($_POST['done'])) {
	$query = "  
           UPDATE comments   
           SET status = '1'         
           WHERE id='$comment_id' ";
        
           $result = mysqli_query($connect, $query);

        }   

if (isset($_POST['undone'])) {
	$query = "  
           UPDATE comments   
           SET status = '0'         
           WHERE id='$comment_id'";
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



