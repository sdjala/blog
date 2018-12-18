<?php  
include '../utils/dbh.php';
session_start();
$date = date('Y-m-d H:i:s');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     echo 'err';
}else {
    $comment = test_input($_POST["comment"]);
    $postID = test_input($_POST["postID"]);
    $uid = $_SESSION['id'];
    
        $query ="INSERT INTO comments(comment, postID, uid, created_at)
        VALUES('$comment', '$postID', '$uid', '$date')";
        $result = mysqli_query($connect, $query);
        if($result){
            echo "ok";
       }
       else{
            echo "err";
       }
    }

    function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }

?>