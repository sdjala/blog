<?php  
include '../../utils/dbh.php';

$output = ''; 

 if(isset($_POST["comment_id"]))  
 try{
 {   
      $query = "SELECT c.id, c.comment, c.status, c.created_at, u.username, a.title 
                    FROM comments c 
                    INNER JOIN users u 
                    ON c.uid = u.id
                    INNER JOIN articles a
                    ON c.postID = a.id
                    WHERE c.status = '0' ";  
      $result = mysqli_query($connect, $query);  
      if($result)  
      {   
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["username"] . '</td>   
                          <td>' . $row["title"] . '</td>  
                          <td>' . $row["created_at"] . '</td>   
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td> 
                          <td><input type="button" name="delete" value="delete" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete_data" /></td>
                          <td><input data-id=' . $row["id"] . ' '.(( $row["status"]  == 0)?'onchange="commentPosted(this);"':'checked onchange="commentUnposted(this);"').' type="checkbox" class="custom-control-input input-task-done" id="customControlAutosizing' . $row["id"] . '" value="'.(($row["status"] == 0)?'1':'0').'"></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  else echo 'err';
      echo $output;  ;  
    } }catch (Exception  $ex) {
        throw new Exception("No user ID \n" . $ex);
    }
  
 ?>