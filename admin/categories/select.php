<?php  
include '../../utils/dbh.php';

 if(isset($_POST["category_id"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM categories WHERE id = '".$_POST["category_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">'.$row["name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Description</label></td>  
                     <td width="70%">'.$row["description"].'</td>  
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