<?php  
include '../utils/dbh.php';

$output = ''; 

 if(isset($_POST["id_post"]))
 $id_post = $_POST["id_post"];  
 try{
 {   
    $comments="SELECT * FROM users JOIN comments ON users.id=uid WHERE postID='$id_post' AND comments.status = '1' ";
    $result = mysqli_query($connect, $comments); 
      if($result)  
      {   
  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '
                <div class="media mb-4"> 
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">' . $row["username"] . '</h5>
                    ' . $row["comment"] . '
                    <button type="button" id="' . $row["id"] . '" class="btn btn-link btn-sm edit_data">Edit</button>
                </div>
                </div>
                      
                ';  
           }  
      }  
      echo $output;  ;  
    } }catch (Exception  $ex) {
        throw new Exception("No user ID \n" . $ex);
    }
 ?>