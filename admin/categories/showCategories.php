<?php  
include '../../utils/dbh.php';

$output = ''; 

 if(isset($_POST["user_id"]))  
 try{
 {   
      $query = "SELECT * FROM categories ORDER BY id DESC";  
      $result = mysqli_query($connect, $query);  
      if($result)  
      {   
  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["name"] . '</td>   
                          <td>' . $row["description"] . '</td>   
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>
                          <td><input type="button" name="delete" value="delete" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete_data" /></td>
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  ;  
    } }catch (Exception  $ex) {
        throw new Exception("No user ID \n" . $ex);
    }
  
 ?>