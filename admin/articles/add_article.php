<?php
include '../../utils/dbh.php';
include '../includes_admin/seoFriendlyUrl.php';

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$sessionID=$_SESSION['id'];

$sql = "SELECT * FROM categories";
$result = mysqli_query($connect, $sql);

if (isset($_POST["upload"])) {
     $title = test_input($_POST['title']);
     $author = test_input($_POST['author']);
     $tags = test_input($_POST['tags']);
     $category = test_input($_POST['category']);
     $date = test_input($_POST['date']);
     $is_feature = test_input($_POST['is_feature']);
     $status = test_input($_POST['status']);
     $summary = test_input($_POST['summary']);
     $body = trim($_POST['body']);
     $image = $_FILES['file-input']['name'];
     $url=generateSeoURL($title, 6);

     // Get Image Dimension
     $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
     $width = $fileinfo[0];
     $height = $fileinfo[1];
     
     $allowed_image_extension = array(
         "png",
         "jpg",
         "jpeg"
     );
     
     // Get image file extension
     $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
     
     // Validate file input to check if is not empty
     if (! file_exists($_FILES["file-input"]["tmp_name"])) {
         $response = array(
             "type" => "error",
             "message" => "Choose image file to upload."
         );
     }    // Validate file input to check if is with valid extension
     else if (! in_array($file_extension, $allowed_image_extension)) {
         $response = array(
             "type" => "error",
             "message" => "No valid image. Only PNG and JPEG are allowed."
         );
     }    // Validate image file size
     else if (($_FILES["file-input"]["size"] > 2000000)) {
         $response = array(
             "type" => "error",
             "message" => "Image size exceeds 2MB"
         );
     }    // Validate image file dimension
     else if ($width > "2000" || $height > "1100") {
         $response = array(
             "type" => "error",
             "message" => "Image dimension should be within 1900X1080"
         );
     } else {
         $target = "../image/" . basename($_FILES["file-input"]["name"]);
         $query = "INSERT INTO articles(title, summary, tags, body, author, image, category, date, is_feature, status, seo_url, uid)
         VALUES ('$title', '$summary', '$tags', '$body', '$author', '$image', '$category', '$date', '$is_feature', '$status', '$url', '$sessionID')"; 
          $result = mysqli_query($connect, $query);

                             

         compressImage($_FILES['file-input']['tmp_name'],$target,60); 
             $response = array(
                 "type" => "success",
                 "message" => "Image uploaded successfully."
             );
         } 
         /*
            * PHP GD
            * adding watermark to an image with GD library
            */
            // Load the watermark and the photo to apply the watermark to
            $stamp = imagecreatefrompng('blog.png');
            $im = imagecreatefromjpeg($target);

            //$stamp = imagescale($stamp, imagesx($im),imagesy($stamp) ,IMG_BICUBIC_FIXED);
            // Set the margins for the stamp and get the height/width of the stamp image
            $marge_right = 0;
            $marge_bottom = 0;
            $sx = imagesx($stamp);
            $sy = imagesy($stamp);

            // Copy the stamp image onto our photo using the margin offsets and the photo 
            // width to calculate positioning of the stamp. 
            imagecopy($im, $stamp, 0, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
            // Output and free memory
            //header('Content-type: image/jpeg');
            $out="../image/".$_FILES["file-input"]["name"];
            imagejpeg($im,$out);
            imagedestroy($im);
     }

      


function compressImage($source, $destination, $quality) {

     $info = getimagesize($source);
   
     if ($info['mime'] == 'image/jpeg') 
       $image = imagecreatefromjpeg($source);
   
     elseif ($info['mime'] == 'image/gif') 
       $image = imagecreatefromgif($source);
   
     elseif ($info['mime'] == 'image/png') 
       $image = imagecreatefrompng($source);
   
     imagejpeg($image, $destination, $quality);
   
   }   

function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }
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
               <h3>Add Article</h3>
               <input type="hidden" name="id_user" id="id_user" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
          </div>

         <div class="container" style="margin-top: 5px;">
		  <div class="row justify-content-center">
			<div class="col-md-8 col-md-offset-2" align="center">

                         <?php if(!empty($response)) { ?>
                              <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div><br/>
                         <?php }?>

				<form class="form-horizontal" method="post" action="article-add" enctype="multipart/form-data">
                         <div class="row">
                              <div class="col-lg-6">
                                        <div class="form-group">
                                             <label class="control-label col-sm-2" for="title">Title:</label>
                                        <div class="col-sm-10">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-pencil"></i>
                                             <input class="form-control" name="title" id="title" placeholder="Title..." required />
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
                                             <input class="form-control" name="author" id="author" placeholder="Author..." required />
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
                                             <input class="form-control" name="tags" id="tags" placeholder="Tags..." required />
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
                                             <input class="form-control" name="date" id="date" placeholder="Date..." required  autocomplete="off"/>
                                        </div>
                                        </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row --><hr/>
                         <div class="row">
                              <div class="col-lg-4">
                                        <div class="form-group">
                                             <label class="control-label col-sm-4" for="tags">Category:</label>
                                        <div class="col-sm-7">
                                        <div class="inner-addon left-addon">
                                             <i class="glyphicon glyphicon-"></i>
                                             <select name="category" id="category" class="form-control">
                                             <?php  while($row = mysqli_fetch_array($result)) {  ?> 
                                                  <option><?php echo $row['name'];?></option>  
                                             <?php }?>
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
                                                  <option value="0">No</option> 
                                                  <option value="1">Yes</option> 
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
                                                       <option value="0">No</option> 
                                                       <option value="1">Yes</option> 
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
                                        <textarea class="form-control" onkeyup="countChar(this)" name="summary" id="summary"  maxlength="350" required rows="5" cols="50"></textarea>
                                        <div style="text-align: right;" id="charNum"></div>
                                   </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row --><hr/>
                         <div class="row">
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="control-label col-sm-2" for="body">Body:</label><hr/>
                                   <div class="col-sm-12">
                                        <textarea class="form-control" name="body" id="body"  maxlength="2000" required></textarea>
                                   </div>
                                   </div>
                              </div><!-- /.col-lg-6 -->
                         </div><!-- /.row --><hr/>
                         <div class="form-row">
                              <div>Choose Image file:</div>
                                   <div>
                                        <input type="file" class="file-input" name="file-input">
                                   </div>
                              </div>
                              <div class="button-row">
                                   <input type="submit" id="btn-submit" name="upload" value="Post">
                              </div>
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
    <script> $(function() { $('textarea#body').froalaEditor({ charCounterMax: 2000,}) }); </script>

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