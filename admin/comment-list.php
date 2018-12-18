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
               <h3>Pending Comments</h3>
               <input type="hidden" name="id_comment" id="id_comment" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
          </div>
          <div class="container" > 
               <div class="row" id="msg"> 
               </div> 
                <br />  
                <div class="table-responsive">   
                     <br />  
                     <div >  
                          <table class="table table-stripped table-hover table-bordered" id="table"> 
                            <thead> 
                               <tr>  
                                   <th width="10%">Username</th>   
                                   <th width="30%">Post Title</th>   
                                   <th width="20%">Date</th> 
                                   <th width="10%">View</th>        
                                   <th width="10%">Edit</th>  
                                   <th width="10%">Actions</th>  
                                   <th width="10%">Check to Post</th>  
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
                     <h4 class="modal-title">Comment</h4>  
                </div>  
                <div class="modal-body" name="comment_id" id="comment_detail"> 
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
                     <h4 class="modal-title">Comment</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Comment</label>  
                          <textarea type="text" name="comment" id="comment" class="form-control"></textarea>    
                          <br />   
                          <input type="hidden" name="comment_id" id="comment_id" />  
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
     var comment_id = $('#id_comment').val();
          $.ajax({
                url:"comments/showComments.php",
                type:"POST",
                data:{comment_id:comment_id},
                success:function(data){
                    $('#user_table').html(data);
                }

            });
     }


        function commentPosted(input){ 
                var comment_id = $(input).attr('data-id');
                $.ajax({
                    url: 'comments/changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        done: 1,
                        comment_id: comment_id
                    },
                    success: function(msg){
                        showTable();
                        alert("Comment is posted!");
                    }
                });
        }

        function commentUnposted(input){
                var comment_id = $(input).attr('data-id');
                $.ajax({
                    url: 'comments/changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        undone: 1,
                        comment_id: comment_id
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
               var comment_id = $(this).attr("id");  
               $.ajax({  
                    url:"comments/delete.php",  
                    method:"POST",  
                    data:{comment_id:comment_id},  
                    success:function(data){ 
                         if(data) { showTable(); 
                         } else {  } 
                         
                    }  
               });  
          });  

          $(document).on('click', '.edit_data', function(){  
               var comment_id = $(this).attr("id");  
               $.ajax({  
                    url:"comments/fetch.php",  
                    method:"POST",  
                    data:{comment_id:comment_id},  
                    dataType:"json",  
                    success:function(data){  
                         $('#comment').val(data.comment);   
                         $('#comment_id').val(data.id);  
                         $('#insert').val("Update");  
                         $('#add_data_Modal').modal('show');  
                    }  
               });  
          });  
          $('#insert_form').on("submit", function(event){  
               event.preventDefault();  
               if($('#comment').val() == "")  
               {  
                    alert("Comment is required");  
               }    
               else  
               {  
                    $.ajax({  
                         url:"comments/insert.php",  
                         method:"POST",  
                         data:$('#insert_form').serialize(),  
                         beforeSend:function(){  
                              $('#insert').val("Inserting");  
                         },  
                         success:function(data){  
                              $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');
                              console.log(data);
                              showTable(); 
                         }  
                    });  
               }  
          });


          $(document).on('click', '.view_data', function(){  
               var comment_id = $(this).attr("id");  
               if(comment_id != '')  
               {  
                    $.ajax({  
                         url:"comments/select.php",  
                         method:"POST",  
                         data:{comment_id:comment_id},  
                         success:function(data){  
                              $('#comment_detail').html(data);  
                              $('#dataModal').modal('show');  
                         }  
                    });  
               }            
          });  
     });  
</script>
