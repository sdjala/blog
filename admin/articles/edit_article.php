<?php
include '../../utils/dbh.php';


session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$sessionID=$_SESSION['id'];

if(isset($_GET['seo_url'])){
    $seo_url = $_GET['seo_url'];
    $query = "SELECT * FROM articles WHERE seo_url='$seo_url' ";
    $result = mysqli_query($connect, $query);
    $article = mysqli_fetch_array($result);
  }

$sql = "SELECT * FROM categories";
$result = mysqli_query($connect, $sql);


?>

<!DOCTYPE html>
<html lang="en">
     <head>
     <meta charset="UTF-8">
     <title>Welcome</title>
     <link rel="stylesheet" type="text/css" href="../css/style.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
 
    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

     <style type="text/css">
          body{ font: 14px sans-serif; text-align: center; }
     </style>
     </head>
     <body>
         <?php include '../includes_admin/header.php'?>

         <div class="page-header">
               <h3>Edit Article</h3>
               <input type="hidden" name="id_user" id="id_user" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
          </div>

         <div class="container" style="margin-top: 5px;">
		  <div class="row justify-content-center">
			<div class="col-md-8 col-md-offset-2" align="center">

                         <?php if(!empty($response)) { ?>
                              <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div><br/>
                         <?php }?>

				<form class="form-horizontal" method="post" action="articles/update" enctype="multipart/form-data">
                         <div class="row">
                              <div class="col-lg-6">
                                        <div class="form-group">
                                             <label class="control-label col-sm-2" for="title">Title:</label>
                                        <div class="col-sm-10">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-pencil"></i>
                                             <input class="form-control" name="title" id="title" value="<?php echo $article['title'];?>" placeholder="Title..." required />
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                              <div class="col-lg-6">
                                        <div class="form-group">
                                             <label class="control-label col-sm-2" for="author">Author:</label>
                                        <div class="col-sm-10">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-user"></i>
                                             <input class="form-control" name="author" id="author" value="<?php echo $article['author'];?>" placeholder="Author..." required />
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row --> <hr/> 
                         <div class="row">
                              <div class="col-lg-6">
                                        <div class="form-group">
                                             <label class="control-label col-sm-2" for="tags">Tags:</label>
                                        <div class="col-sm-10">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-tags"></i>
                                             <input class="form-control" name="tags" id="tags" value="<?php echo $article['tags'];?>" placeholder="Tags..." required />
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                              <div class="col-lg-6">
                                        <div class="form-group">
                                             <label class="control-label col-sm-2" for="date">Date:</label>
                                        <div class="col-sm-10">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-calendar"></i>
                                             <input class="form-control" name="date" id="date" value="<?php echo $article['date'];?>" placeholder="Date..." required  autocomplete="off"/>
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row --><hr/>
                         <div class="row">
                              <div class="col-lg-4">
                                        <div class="form-group">
                                             <label class="control-label col-sm-4" for="category">Category:</label>
                                        <div class="col-sm-7">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-"></i>
                                             <select name="category" id="category" class="form-control">
                                             <?php if(isset($article['category'])) {?>
                                                <option ><?php echo $article['category'];?></option>
                                            <?php }?>
                                             <?php  while($row = mysqli_fetch_array($result)) {  
                                                 if( $article['category'] !=  $row['name']) {?> 
                                                  <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>  
                                             <?php } }?>
                                             </select> 
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                              <div class="col-lg-4">
                                        <div class="form-group">
                                             <label class="control-label col-sm-5" for="date">Is feature:</label>
                                        <div class="col-sm-6">
                                        <div class="inner-addon left-addon">
                                             <select name="is_feature" id="is_feature" class="form-control">
                                                <?php if($article['is_feature'] == 0){ ?>
                                                   <option value="<?php echo $article['is_feature'];?>">No</option> 
                                                   <option value="1">Yes</option> 
                                                   <?php }else{ ?> 
                                                   <option value="<?php echo $article['is_feature'];?>">Yes</option> 
                                                   <option value="0">No</option> 
                                                <?php } ?> 
                                             </select> 
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                              <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role'])){ 
                                   $role = $_SESSION['role']; 
                                   if($role=="1"){?>
                                        <div class="col-lg-4">
                                             <div class="form-group">
                                                  <label class="control-label col-sm-4" for="date">Status:</label>
                                             <div class="col-sm-6">
                                             <div class="inner-addon left-addon">
                                                  <select name="status" id="status" class="form-control">
                                                     <?php if($article['status'] == 0){ ?>
                                                        <option value="<?php echo $article['status'];?>">No</option> 
                                                        <option value="1">Yes</option> 
                                                        <?php }else{ ?> 
                                                        <option value="<?php echo $article['status'];?>">Yes</option> 
                                                        <option value="0">No</option> 
                                                     <?php } ?>
                                                  </select> 
                                             </div>
                                             </div>
                                        </div>
                                   </div><!-- /.col-lg-6 -->
                              <?php } ?>
                              <?php } ?>
                         </div><!-- /.row --><hr/>
                         <div class="row">
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="control-label col-sm-2" for="summary">Summary:</label>
                                   <div class="col-sm-10">
                                        <textarea class="form-control" onkeyup="countChar(this)" name="summary" id="summary"  maxlength="350" required rows="5" cols="50"><?php echo $article['summary'];?></textarea>
                                        <div style="text-align: right;" id="charNum"></div>
                                   </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row --><hr/>
                         <div class="row">
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="control-label col-sm-2" for="froala-editor">Body:</label><hr/>
                                   <div class="col-sm-12">
                                        <textarea class="form-control" name="froala-editor" id="froala-editor"  maxlength="2000" required><?php echo $article['body'];?></textarea>
                                   </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row -->
                            <input type="hidden" name="article_id" id="article_id" value="<?php echo $article['id'];?>" />
                              <div class="button-row">
                                   <input type="submit" id="btn-submit" name="upload" value="Update">
                              </div>

				</form>
			</div>
		</div>
	</div>

    </body>
</html>

<script>
     $(document).ready(function () {
          var date = new Date();
          var currentMonth = date.getMonth();
          var currentDate = date.getDate();
          var currentYear = date.getFullYear();

          $('#date').datepicker({
               minDate: new Date(currentYear, currentMonth, currentDate),
               dateFormat: 'yy-mm-dd'
          });
     });
</script>

    <!-- Include external JS libs. 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
     -->
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
 
    <!-- Initialize the editor. -->
    <script> $(function() { $('textarea#froala-editor').froalaEditor({
         toolbarInline: false,
         charCounterMax: 1800,
               }) 
         }); </script>

       <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 350) {
          val.value = val.value.substring(0, 350);
        } else {
          $('#charNum').text(350 - len - 1);
        }
      };
    </script>