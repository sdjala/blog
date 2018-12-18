<?php
include 'utils/dbh.php';

$query_isfeature="SELECT * FROM articles WHERE is_feature='1' AND status='1' ORDER BY date DESC LIMIT 6";
$result_isfeature = mysqli_query($connect, $query_isfeature);

$query_postCards="SELECT * FROM articles WHERE status='1' ORDER BY date DESC LIMIT 6";
$result_postCards = mysqli_query($connect, $query_postCards);

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="utils/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/half-slider.css" rel="stylesheet">

  </head>

  <body>

   <?php include 'includes/header.php'; ?>


    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('admin/image/blogging.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Welcome</h3>
              <p>Here you will find different quotes.</p>
            </div>
          </div>
          <?php  while($row = mysqli_fetch_array($result_isfeature)) { ?>  
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('admin/image/<?php echo $row['image'];?>')">
            <div class="carousel-caption d-none d-md-block">
              <a href="<?php echo $row['seo_url'];?>"><h3 style="text-decoration: none; color: rgb(255,255,255);"><?php echo $row['title'];?></h3></a>
              <p>Posted on <?php echo $row['date'];?> by <?php echo $row['author'];?></p>
            </div>
          </div>
          <?php } ?>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="row">
        <?php  while($row = mysqli_fetch_array($result_postCards)) { ?>  
          <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-80">
              <img class="card-img-top" style="height: 200px;" src="admin/image/<?php echo $row['image'];?>" alt="">
              <div class="card-body" style="height: 350px;">
                <h5 class="card-title">
                  <a href="<?php echo $row['seo_url'];?>"><?php echo $row['title'];?></a>
                </h5>
                <p class="card-text" ><?php echo $row['summary'];?></p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>

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
