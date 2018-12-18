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
     <link rel="stylesheet" type="text/css" href="../css/style.css">

     <style type="text/css">
          body{ font: 14px sans-serif; text-align: center; }
     </style>
     </head>
     <body>
         <?php include 'includes_admin/header.php'?>
          <div class="page-header">
               <h3>Manage Users</h3>
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
                                   <th width="30%">Username</th>   
                                   <th width="30%">Email</th>      
                                   <th width="10%">Edit</th>  
                                   <th width="10%">View</th>   
                                   <th width="10%">Actions</th>  
                                   <th width="10%">Status</th>  
                               </tr> 
                            <thead>
                            <tbody id="user_table">
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
                     <h4 class="modal-title">User Details</h4>  
                </div>  
                <div class="modal-body" name="user_id" id="user_detail"> 
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
                     <h4 class="modal-title">User</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Username</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Email</label>  
                          <input type="email" name="email" id="email" class="form-control"/>  
                          <br />  
                          <label>Password</label>  
                          <input type="password" name="password" id="password" class="form-control"/>  
                          <br />    
                          <label>Select Role</label>  
                          <select name="role" id="role" class="form-control">  
                               <option value="1">Admin</option>  
                               <option value="2">Editor</option>  
                               <option value="3">User</option>  
                          </select>  
                          <br />  
                          <label>Select Status</label>  
                          <select name="status" id="status" class="form-control">  
                               <option value="0">Inactive</option>  
                               <option value="1">Active</option>  
                          </select> 
                          <br />  
                          <label>Select Email status</label>  
                          <select name="estatus" id="estatus" class="form-control">  
                               <option value="0">Unconfirmed</option>  
                               <option value="1">Confirmed</option>  
                          </select>  
                          <br />   
                          <input type="hidden" name="user_id" id="user_id" />  
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
                url:"users/showUsers.php",
                type:"POST",
                data:{user_id:user_id},
                success:function(data){
                    $('#user_table').html(data);
                }

            });
     }


        function userActive(input){ 
                var user_id = $(input).attr('data-id');
                $.ajax({
                    url: 'users/changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        done: 1,
                        user_id: user_id
                    },
                    success: function(msg){
                        showTable();
                        alert("User is active!");
                    }
                });
        }

        function userInactive(input){
                var user_id = $(input).attr('data-id');
                $.ajax({
                    url: 'users/changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        undone: 1,
                        user_id: user_id
                    },
                    success: function(msg){
                        showTable();
                        alert("User is inactive!");
                    }
                });
        }
     
     $(document).ready(function(){
          
          showTable();

          $(document).on('click', '.delete_data', function(){   
               var user_id = $(this).attr("id");  
               $.ajax({  
                    url:"users/delete.php",  
                    method:"POST",  
                    data:{user_id:user_id},  
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
               var user_id = $(this).attr("id");  
               $.ajax({  
                    url:"users/fetch.php",  
                    method:"POST",  
                    data:{user_id:user_id},  
                    dataType:"json",  
                    success:function(data){  
                         $('#name').val(data.username);  
                         $('#email').val(data.email);  
                         $('#role').val(data.role_id);  
                         $('#status').val(data.status);   
                         $('#estatus').val(data.isEmailConfirmed);  
                         $('#user_id').val(data.id);  
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
               else if($('#priority').val() == '')  
               {  
                    alert("Priority is required");  
               }  
               else if($('#deadline').val() == '')  
               {  
                    alert("Deadline is required");  
               }  
               else  
               {  
                    $.ajax({  
                         url:"users/insert.php",  
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
               var user_id = $(this).attr("id");  
               if(user_id != '')  
               {  
                    $.ajax({  
                         url:"users/select.php",  
                         method:"POST",  
                         data:{user_id:user_id},  
                         success:function(data){  
                              $('#user_detail').html(data);  
                              $('#dataModal').modal('show');  
                         }  
                    });  
               }            
          });  
     });  
</script>
