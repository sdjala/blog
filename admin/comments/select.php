<?php  
include '../../utils/dbh.php';

 if(isset($_POST["comment_id"]))  
 {  
      //echo 'ok';
      $output = '';  
      $query = "SELECT * FROM comments WHERE id = '".$_POST["comment_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Comment</label></td>  
                     <td width="70%">'.$row["comment"].'</td>  
                </tr>     
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }else {echo 'error';}  
 ?>