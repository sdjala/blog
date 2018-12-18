<?php

include '../../utils/dbh.php';

$article_id = $_POST['article_id'];
if (isset($_POST['done'])) {
	$query = "  
           UPDATE articles   
           SET status = '1'         
           WHERE id='$article_id' ";
        
           $result = mysqli_query($connect, $query);

        }   

if (isset($_POST['undone'])) {
	$query = "  
           UPDATE articles   
           SET status = '0'         
           WHERE id='$article_id'";
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



