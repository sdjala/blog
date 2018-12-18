
<?php  
include '../utils/dbh.php';
session_start();
$date = date('Y-m-d H:i:s');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     echo 'err';
}else {
        $comment_id = test_input($_POST["comment_id"]);
        if(!empty($_POST)) 
            {  

                $comment = mysqli_real_escape_string($connect, $_POST['comment_text']);   
                if($_POST["comment_id"] != '')  
                {  
                    $query = "  
                    UPDATE comments   
                    SET    
                    comment = '$comment',
                    updated_at = '$date'       
                    WHERE id='$comment_id'";   
                }  
                else  
                {  
                } 

                $result = mysqli_query($connect, $query);
                if($result){
                    echo "ok";
               }
               else{
                    echo "err";
               }
                }
            
            }  

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
           
     
 ?>