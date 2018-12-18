<?php

session_start();
$sessionID=$_SESSION['id'];

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
          header("location: ../login");
    exit;
}

// Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role'])){
     $role = $_SESSION['role'];
          if($role!=="1"){header("location: ../login");}
     }

?>
 
<!DOCTYPE html>
<html lang="en">
     <head>
     <meta charset="UTF-8">
     <title>Welcome</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

     <style type="text/css">
          body{ font: 14px sans-serif; text-align: center; }
     </style>
     </head>
     <body>
         <?php include 'includes_admin/header.php'?>
          <div class="page-header">
                <h3>Manage Categories</h3>
               <input type="hidden" name="id_user" id="id_user" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
          </div>
          <div class="container" style="width:800px;"> 
               <div class="row" id="msg"> 
               </div> 
                <br />  
                <div class="table-responsive">  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add</button>  
                     </div>  
                     <br />  
                     <div >  
                          <table class="table table-stripped table-hover table-bordered" id="table"> 
                            <thead> 
                               <tr>  
                                   <th width="20%">Name</th>   
                                   <th width="20%">Description</th>     
                                   <th width="10%">Edit</th>  
                                   <th width="10%">View</th>   
                                   <th colspan="2" width="10%">Actions</th>  
                               </tr> 
                            <thead>
                            <tbody id="category_table">
                            </tbody> 
                          </table>   
                     </div>  
                </div>
          </div>  
    </body>
</html>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Category</h4>  
                </div>  
                <div class="modal-body" name="category_id" id="category_detail"> 
                </div>  
                <div class="modal-footer"> 
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Task</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Enter Category Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Category Description</label>  
                          <textarea name="description" id="description" class="form-control"></textarea>  
                          <br />    
                          <input type="hidden" name="category_id" id="category_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 
  
 <script>  

     function showTable(){
     var user_id = $('#id_user').val();
          $.ajax({
                url:"categories/showCategories.php",
                type:"POST",
                data:{user_id:user_id},
                success:function(data){
                    $('#category_table').html(data);
                }

            });
     }
   
     $(document).ready(function(){
          
          showTable();

          $(document).on('click', '.delete_data', function(){   
               var category_id = $(this).attr("id");  
               $.ajax({  
                    url:"categories/delete.php",  
                    method:"POST",  
                    data:{category_id:category_id},  
                    success:function(data){ 
                         if(data) { showTable(); 
                         } else {  } 
                         
                    }  
               });  
          });  

          $('#add').click(function(){  
               $('#insert').val("Insert");  
               $('#insert_form')[0].reset();  
               $('#insert_form').find("input[type=hidden]").val(""); 
          }); 

          $(document).on('click', '.edit_data', function(){  
               var category_id = $(this).attr("id");  
               $.ajax({  
                    url:"categories/fetch.php",  
                    method:"POST",  
                    data:{category_id:category_id},  
                    dataType:"json",  
                    success:function(data){  
                         $('#name').val(data.name);  
                         $('#description').val(data.description);   
                         $('#category_id').val(data.id);  
                         $('#insert').val("Update");  
                         $('#add_data_Modal').modal('show');  
                    }  
               });  
          });  
          $('#insert_form').on("submit", function(event){  
               event.preventDefault();  
               if($('#name').val() == "")  
               {  
                    alert("Name is required");  
               }  
               else if($('#description').val() == '')  
               {  
                    alert("Description is required");  
               }  
               else  
               {  
                    $.ajax({  
                         url:"categories/insert.php",  
                         method:"POST",  
                         data:$('#insert_form').serialize(),  
                         beforeSend:function(){  
                              $('#insert').val("Inserting");  
                         },  
                         success:function(data){  
                              $('#insert_form')[0].reset(); 
                              $('#insert_form').find("input[type=hidden]").val(""); 
                              $('#add_data_Modal').modal('hide');
                              console.log(data);
                              showTable(); 
                         }  
                    });  
               }  
          });


          $(document).on('click', '.view_data', function(){  
               var category_id = $(this).attr("id");  
               if(category_id != '')  
               {  
                    $.ajax({  
                         url:"categories/select.php",  
                         method:"POST",  
                         data:{category_id:category_id},  
                         success:function(data){  
                              $('#category_detail').html(data);  
                              $('#dataModal').modal('show');  
                         }  
                    });  
               }            
          });  
     });  
</script>