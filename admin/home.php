<?php
include '../utils/dbh.php';

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

     $sql_articles="SELECT count(*) AS records_count FROM articles WHERE status='0'";
     $result_articles=mysqli_query($connect, $sql_articles);
     $number_of_articles = mysqli_fetch_array($result_articles);
     $number_of_articles = $number_of_articles['records_count'];

     $sql_comments="SELECT count(*) AS records_count FROM comments WHERE status='0'";
     $result_comments=mysqli_query($connect, $sql_comments);
     $number_of_comments = mysqli_fetch_array($result_comments);
     $number_of_comments = $number_of_comments['records_count'];
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
          .list-inline {
  display: flex;
  justify-content: center;
}
     </style>
     </head>
     <body>
         <?php include 'includes_admin/header.php'?>
          <div class="page-header">
               <input type="hidden" name="id_user" id="id_user" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
               <h3>Welcome<h3> 
          </div>
          <div class="container"> 
          <ul class="nav nav-pills list-inline" role="tablist">
                    <li role="presentation" class=""><a href="articles-pending">Articles Pending <span class="badge"><?php echo $number_of_articles; ?></span></a></li>
                    <li role="presentation"><a href="comment-list">Comments Pending <span class="badge"><?php echo $number_of_comments; ?></span></a></li>
               </ul>
               <!--<?php  while($post = mysqli_fetch_array($result_posts)) {  ?>
                    <?php $post_id= $post['postID'];?>
                    <div class="panel panel-default">
                         <div class="panel-heading"><?php echo $post['title'];?><?php echo $post['postID'];?></div>
                         <?php  $slq_comments="SELECT * FROM comments WHERE status = '0' and postID = '$post_id' ";
                              $result_comments=mysqli_query($connect, $slq_comments);
                              while($comment = mysqli_fetch_array($result_comments)) { ?>
                                   <div class="panel-body">
                                        <?php echo $comment['comment'];?>
                                   </div>
                         <?php } ?> -->

                    </div>
               <?php } ?>
          </div>  
    </body>
</html>
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Task Details</h4>  
                </div>  
                <div class="modal-body" name="task_id" id="task_detail"> 
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
                          <label>Enter Task Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Task Description</label>  
                          <textarea name="description" id="description" class="form-control"></textarea>  
                          <br />  
                          <label>Select Priority</label>  
                          <select name="priority" id="priority" class="form-control">  
                               <option value="low">Low</option>  
                               <option value="medium">Medium</option>  
                               <option value="high">High</option>  
                          </select>  
                          <br />  
                          <label>Deadline</label>  
                          <input type="text" name="deadline" id="deadline" class="form-control"  autocomplete="off"/>  
                          <br />    
                          <input type="hidden" name="task_id" id="task_id" />  
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
                url:"showTasks.php",
                type:"POST",
                data:{user_id:user_id},
                success:function(data){
                    $('#task_table').html(data);
                    sortTable();
                }

            });
     }

     function sortTable(){
            $('#table #task_table').sortable({
                items: "tr:not(.nosort)",
                update: function(event, ui){
                    $(this).children().each(function(index){
                        if($(this).attr('data-position') != (index+1)){
                            $(this).attr('data-position', (index+1)).addClass('updated');
                        }
                    });

                    saveNewPositions();
                }
            });
        }
        
        function saveNewPositions() {
            var positions = [];
            $('.updated').each(function () {
               positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
               $(this).removeClass('updated');
            });

            $.ajax({
               url: 'position.php',
               method: 'POST',
               dataType: 'text',
               data: {
                   update: 1,
                   positions: positions
               }, success: function (response) {
                    console.log(response);
               }
            });
        }

        function taskDone(input){ 
                var task_id = $(input).attr('data-id');
                $.ajax({
                    url: 'changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        done: 1,
                        task_id: task_id
                    },
                    success: function(msg){
                        showTable();
                        alert("Task marked as Done!");
                    }
                });
        }

        function taskUndone(input){
                var task_id = $(input).attr('data-id');
                $.ajax({
                    url: 'changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        undone: 1,
                        task_id: task_id
                    },
                    success: function(msg){
                        showTable();
                        alert("Task marked as Undone!");
                    }
                });
        }
     
     $(document).ready(function(){
          
          showTable();

          $(document).on('click', '.delete_data', function(){   
               var task_id = $(this).attr("id");  
               $.ajax({  
                    url:"delete.php",  
                    method:"POST",  
                    data:{task_id:task_id},  
                    success:function(data){ 
                         if(data) { showTable(); 
                         } else {  } 
                         
                    }  
               });  
          });  

          $('#add').click(function(){  
               $('#insert').val("Insert");  
               $('#insert_form')[0].reset();  
          }); 

          $(document).on('click', '.edit_data', function(){  
               var task_id = $(this).attr("id");  
               $.ajax({  
                    url:"fetch.php",  
                    method:"POST",  
                    data:{task_id:task_id},  
                    dataType:"json",  
                    success:function(data){  
                         $('#name').val(data.name);  
                         $('#description').val(data.description);  
                         $('#priority').val(data.priority);  
                         $('#deadline').val(data.deadline);  
                         $('#task_id').val(data.id);  
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
                         url:"insert.php",  
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
               var task_id = $(this).attr("id");  
               if(task_id != '')  
               {  
                    $.ajax({  
                         url:"select.php",  
                         method:"POST",  
                         data:{task_id:task_id},  
                         success:function(data){  
                              $('#task_detail').html(data);  
                              $('#dataModal').modal('show');  
                         }  
                    });  
               }            
          });  
     });  
</script>

<script>
     $(document).ready(function () {
          var date = new Date();
          var currentMonth = date.getMonth();
          var currentDate = date.getDate();
          var currentYear = date.getFullYear();

          $('#deadline').datepicker({
               minDate: new Date(currentYear, currentMonth, currentDate),
               dateFormat: 'yy-mm-dd'
          });
     });
</script>