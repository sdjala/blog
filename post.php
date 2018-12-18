<?php
include 'utils/dbh.php';

$qry_categ="SELECT DISTINCT * FROM categories";
$result_categ = mysqli_query($connect, $qry_categ);

if(isset($_GET['seo_url'])){
  $seo_url = $_GET['seo_url'];
  $query = "SELECT * FROM articles WHERE seo_url='$seo_url' ";
  $result = mysqli_query($connect, $query);
  $article = mysqli_fetch_array($result);
}

$commentedPost = $article['id'];


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Post</title>

    <!-- Bootstrap core CSS -->
    <link href="utils/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
     <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <?php include 'includes/header.php'; ?>
    <input type="hidden" name="id_post" id="id_post" value="<?php echo $commentedPost; ?>">
    <!-- Page Content -->
    <div class="container">
      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4"><?php echo $article['title'];?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="#"><?php echo $article['author'];?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $article['date'];?></p>

          <hr>

          <!-- Preview Image -->
          <img class="img-fluid rounded" style="width: 700px; height:350px;" src="admin/image/<?php echo $article['image'];?>" alt="">

          <hr>

          <!-- Post Content -->        
          <div class="d-inline">
            <span>Tags: </span>
            <?php $tags= $article['tags'];
              $tag = explode(',', $tags);
              foreach ($tag as $tag){ ?>
                  <a href="search?q=<?php echo $tag;?>">|<?php echo $tag;?></a>
              <?php } ?>
             </div>
          <div class="fr-view">
          <p><?php echo $article['body'];?></p>
          </div>
          <hr>

          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form id="comment_form" method="post" action="post_comment/insert" enctype="multipart/form-data">
                <input type="hidden" name="postID" value="<?php echo $article['id'];?>">
                  <div class="form-group">
                    <textarea class="form-control" name="comment" id="comment" rows="3" required maxlength="150"></textarea>
                  </div>
                <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Submit" />
              </form>
            </div>
          </div>
          

          <!-- Single Comment -->
          <div id="comments"></div>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

         <!-- Categories Widget -->
         <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
              <?php  while($categ = mysqli_fetch_array($result_categ)) { ?>
                <a style="margin-right: 5px;" href="search?q=<?php echo $categ['name'];?>"><?php echo $categ['name'];?></a>
              <?php } ?>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="utils/vendor/jquery/jquery.min.js"></script>
    <script src="utils/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

 <!-- Modal -->
<div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="insert_form">   
              <label>Comment</label>  
              <textarea name="comment_text" id="comment_text" class="form-control"  maxlength="150" required rows="5"></textarea>  
              <br /> 
              <input type="hidden" name="comment_id" id="comment_id" />  
              <button type="submit" name="insert" id="insert" class="btn btn-primary">Update</button>        
         </form>  
      </div>
      <div class="modal-footer">
      <button type="submit" onclick="deleteComment();" class="btn btn-danger">Delete</button>  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

      function showComments(){
        var id_post = $('#id_post').val();
                    $.ajax({
                          url:"post_comment/show.php",
                          type:"POST",
                          data:{id_post:id_post},
                          success:function(data){
                              $('#comments').html(data);
                          }

                      });
              }

        function deleteComment(){   
          var comment_id = $('#comment_id').val(); 
               $.ajax({  
                    url:"post_comment/delete.php",  
                    method:"POST",  
                    data:{comment_id:comment_id},
                success: function(msg){
                    $("#add_data_Modal").modal("hide");
                    showComments();
                }     
                });
          }

          $(document).ready(function(){
          
            showComments();


          $(document).on('click', '.edit_data', function(){  
               var comment_id = $(this).attr("id");  
               $.ajax({  
                    url:"post_comment/fetch.php",  
                    method:"POST",  
                    data:{comment_id:comment_id},  
                    dataType:"json",  
                    success:function(data){
                        $('#comment_text').val(data.comment);   
                         $('#comment_id').val(data.id);  
                         $('#insert').val("Update");  
                         $('#add_data_Modal').modal('show');                        
                    },  error: function(){
                      alert('Login your acoount');
                    } 
               });  
          });
          $('#insert_form').on("submit", function(event){  
               event.preventDefault();    
                    $.ajax({  
                         url:"post_comment/update.php",  
                         method:"POST",  
                         data:$('#insert_form').serialize(),  
                         beforeSend:function(){  
                              $('#insert').val("Inserting");  
                         },  
                         success:function(data){  
                              $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');
                              showComments();
                              console.log(data);
                         }  
                    });  
               
          });  

      $("#comment_form").submit(function(event){
        event.preventDefault(); //prevent default action 
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = $(this).serialize(); //Encode form elements for submission
        
        $.ajax({
          url : post_url,
          type: request_method,
          data : form_data
        }).done(function(msg){ //
          if(msg == 'ok'){
                      alert("Your comment will be posted soon.");
                    }else{
                      alert("Login Please.");
                    }
        });
      });
    });

      
</script>