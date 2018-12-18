<?php  
include '../../utils/dbh.php';

 if(isset($_POST["user_id"]))  
 {  
      //echo 'ok';
      $output = '';  
      $query = "SELECT * FROM users WHERE id = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Username</label></td>  
                     <td width="70%">'.$row["username"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">'.$row["email"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Role</label></td>  
                     <td width="70%">'.$row["role_id"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Status</label></td>  
                     <td width="70%">'.$row["status"].'</td>  
                </tr>    
                <tr>  
                     <td width="30%"><label>Email Confirmation</label></td>  
                     <td width="70%">'.$row["isEmailConfirmed"].'</td>  
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