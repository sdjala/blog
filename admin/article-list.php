<?php
include '../utils/dbh.php';
include 'includes_admin/pagination.php';

session_start();
$sessionID=$_SESSION['id'];

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
          header("location: ../login");
    exit;
}

// Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role'])){
     $role = $_SESSION['role'];
          if($role=="3"){header("location: ../login");}
     }

 
$sql_categ = "SELECT * FROM categories";
$result_categ = mysqli_query($connect, $sql_categ);

$sql_articles = "SELECT * FROM articles ORDER BY position LIMIT " . $this_page_first_result . ',' . $results_per_page;
$result_articles = mysqli_query($connect, $sql_articles);

?>
 
<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <title>Welcome</title>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
          <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
          <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
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
               <h3>Manage Articles</h3>
               <input type="hidden" name="id_user" id="id_user" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
               <div align="right" style="margin-right:50px;">  
               <a href="article-add" class="btn btn-info" role="button">Add Article</a>  
               <?php if($role=="1"){?>
               <a href="articles-pending" class="btn btn-default" role="button">Pending</a> 
               <?php } ?> 
                </div> 
          </div>
          <div class="container" style="width:;"><br />  
               <ul class="list-unstyled" id="page_list">
                    <?php  while($row = mysqli_fetch_array($result_articles)) {  ?>
                         <li id="<?php echo $row['id']; ?>"> 
                         <div class="row">
                              <div class="col-xs-12 col-md-10">
                                   <div class="media">
                                        <a href="image/<?php echo $row['image'];?>" class="pull-left"  target="_blank">
                                             <img src="image/<?php echo $row['image'];?>" class="thumbnail" alt="Sample Image" height="168" width="180">
                                        </a>
                                        <div class="media-body">
                                             <div class="panel panel-default">
                                             <div class="panel-heading">
                                                  <h3 class="panel-title"><b><?php echo $row['title'];?></b></h3>
                                             </div>
                                             <div class="panel-body">
                                                  <p class="card-text" align="left"><?php echo $row['summary'];?></p>
                                                  <a class="btn btn-default btn-xs" href="article-edit-<?php echo $row['seo_url'];?>" role="button">Edit</a>
                                                  <a class="btn btn-default btn-xs" href="../<?php echo $row['seo_url'];?>" role="button">View</a>
                                                  <?php if($role=="1"){?>
                                                            <button type="button" id="<?php echo $row['id'];?>" class="btn btn-default btn-xs edit_data">Delete</button>
                                                            <span>Status:</span> <?php echo '<td><input data-id=' . $row["id"] . ' '.(( $row["status"]  == 0)?'onchange="articlePosted(this);"':'checked onchange="articleUnposted(this);"').' type="checkbox" class="custom-control-input input-task-done" id="customControlAutosizing' . $row["id"] . '" value="'.(($row["status"] == 0)?'1':'0').'"></td>' ?>
                                                       <?php } ?>
                                             </div>
                                             </div>    
                                        </div>
                                   </div><hr>
                              </div>
                         </div>
                         </li>
                    <?php }?>
                </ul>
                     <!-- Pagination -->
                    <ul class="pagination justify-content-center mb-4">
                    <?php if($page > 1){ ?>
                      <li class="page-item">
                        <a class="page-link" href="article-list-<?php echo $previous_page;?>">&larr; Older</a>
                      </li>
                    <?php }else {?> 
                      <li class="page-item disabled">
                        <a class="page-link" href="">&larr; Older</a>
                      </li>
                    <?php } ?>
                    <?php for ($i=1; $i <= $number_of_pages; $i++){?>
			          <li><a href="article-list-<?php echo $i;?>"><?php echo $i; ?> </a></li>
                     <?php } ?>
                    <?php if($page < $number_of_pages){ ?>
                      <li class="page-item">
                        <a class="page-link" href="article-list-<?php echo $next_page;?>">Newer &rarr;</a>
                      </li>
                      <?php }else {?> 
                        <li class="page-item disabled">
                        <a class="page-link" href="">Newer &rarr;</a>
                      </li>
                      <?php } ?>
                    </ul>
          </div>  
    </body>
</html> 
<div id="edit_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header ">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Article</h4>  
                </div>  
                <div class="modal-body">  
                    <h3>Are you sure you want to delete?</h3>
                    <input type="hidden" name="article_id" id="article_id" />
                </div>  
                <div class="modal-footer">
                     <button type="submit" onclick="deleteArticle();" class="btn btn-danger">Delete</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 

<script>
     $(document).ready(function(){
          $( "#page_list" ).sortable({
               placeholder : "ui-state-highlight",
               update  : function(event, ui)
               {
                    var page_id_array = new Array();
                    $('#page_list li').each(function(){
                    page_id_array.push($(this).attr("id"));
                    });

                    $.ajax({
                    url:"articles/position.php",
                    method:"POST",
                    data:{page_id_array:page_id_array},
                    success:function(data)
                    {
                         alert(data);
                    }
                    });
               }
          });

          $(document).on('click', '.edit_data', function(){  
               var article_id = $(this).attr("id");  
               $.ajax({  
                    url:"articles/fetch.php",  
                    method:"POST",  
                    data:{article_id:article_id},  
                    dataType:"json",  
                    success:function(data){
                         $('#article_id').val(data.id);   
                         $('#edit_data_Modal').modal('show');                        
                    } 
               });  
          });

     });
</script>
 <script>  
     function deleteArticle(){   
          var article_id = $('#article_id').val(); 
               $.ajax({  
                    url:"articles/delete.php",  
                    method:"POST",  
                    data:{article_id:article_id},
                success: function(msg){
                    $("#edit_data_Modal").modal("hide");
                         location.reload();
                }     
                });
          }

        function articlePosted(input){ 
                var article_id = $(input).attr('data-id');
                $.ajax({
                    url: 'articles/changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        done: 1,
                        article_id: article_id
                    },
                    success: function(msg){
                        alert("Article is Posted!");
                    }
                });
        }

        function articleUnposted(input){
                var article_id = $(input).attr('data-id');
                $.ajax({
                    url: 'articles/changeStatus.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        undone: 1,
                        article_id: article_id
                    },
                    success: function(msg){
                        alert("Article is Unposted!");
                    }
                });
        }
     
</script>

