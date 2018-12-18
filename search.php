<?php
include 'utils/dbh.php';
include 'includes/pagination.php';

$qry_categ="SELECT DISTINCT * FROM categories";
$result_categ = mysqli_query($connect, $qry_categ);

if(isset($_GET['q']))
{

    $q = test_input($_GET['q']);
    
    $results_per_page=2;

        $sql="SELECT count(*) AS records_count FROM articles WHERE status='1' AND title LIKE '%".$q."%'  ";
        $result=mysqli_query($connect, $sql);
        $number_of_results = mysqli_fetch_array($result);

        $number_of_results = $number_of_results['records_count'];


        $number_of_pages = ceil($number_of_results/$results_per_page);

        if (!isset($_GET['page'])){
            $page=1;
        }else{
            $page=$_GET['page'];
        }

        $this_page_first_result = ($page-1)*$results_per_page;

        $previous_page=$page-1;
        $next_page=$page+1;

 
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM articles WHERE status = '1' AND CONCAT(`title`, `tags`, `category`)  LIKE '%".$q."%' ORDER BY date DESC LIMIT " . $this_page_first_result . ',' . $results_per_page;
    
}

$result = mysqli_query($connect, $query);

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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Posts</title>

    <!-- Bootstrap core CSS -->
    <link href="utils/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <?php include 'includes/header.php'; ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Blog Posts
            <small>Order by date</small>
          </h1>
          <?php  while($row = mysqli_fetch_array($result)) { ?>  
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="admin/image/<?php echo $row['image'];?>" alt="Card image cap">
            
            
            <div class="card-body">
              <h2 class="card-title"><?php echo $row['title'];?></h2>
              <p class="card-text"><?php echo $row['summary'];?></p>
              <a href="<?php echo $row['seo_url'];?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $row['date'];?> by
              <a href="#"><?php echo $row['author'];?></a>
            </div>
          </div>
          <?php } ?>

          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
          <?php if($page > 1){ ?>
            <li class="page-item">
              <a class="page-link" href="search?page=<?php echo $previous_page;?>&q=<?php echo $_GET['q'];?>">&larr; Older</a>
            </li>
          <?php }else {?> 
            <li class="page-item disabled">
              <a class="page-link" href="">&larr; Older</a>
            </li>
          <?php } ?>
          <?php if($page < $number_of_pages){ ?>
            <li class="page-item">
              <a class="page-link" href="search?page=<?php echo $next_page;?>&q=<?php echo $_GET['q'];?>">Newer &rarr;</a>
            </li>
            <?php }else {?> 
              <li class="page-item disabled">
              <a class="page-link" href="">Newer &rarr;</a>
            </li>
            <?php } ?>
          </ul>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
              <form action="search" method="GET" class="form-inline">
                <input type="text" name="q" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
                </form>
              </div>
            </div>
          </div>

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
