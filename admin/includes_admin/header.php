
<nav style="background-color: rgb(52,58,64); border-color: rgb(52,58,64); border-radius: 0; min-height: 60px;" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
             <a style="margin-left:88px; padding-top:20px;" class="navbar-brand" href="/blog">Blog</a>
        </div>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role'])){ 
          $role = $_SESSION['role']; 
          if($role=="1"){?>
               <ul class="nav navbar-nav">
                    <li style="padding-top:5px;" class=""><a href="home">Home</a></li>
               </ul>
               <ul class="nav navbar-nav">
                    <li style="padding-top:5px;" class=""><a href="category-list">Categories</a></li>
               </ul>
               <ul class="nav navbar-nav">
                    <li style="padding-top:5px;" class=""><a href="user-list">Users</a></li>
               </ul>
               <ul class="nav navbar-nav">
                    <li style="padding-top:5px;" class=""><a href="comment-list">Comments</a></li>
               </ul>
          <?php } ?>
        <?php } ?>
        <ul class="nav navbar-nav">
             <li style="padding-top:5px;" class=""><a href="article-list">Articles</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
             <li><a style="padding-top:20px;" href="home"><span class="glyphicon glyphicon-user"></span> <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></a></li>
             <li><a style="margin-right:90px; padding-top:20px;" href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
        </ul>
    </div>
</nav>