<?php session_start();?> 

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/blog">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/blog">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="post-list">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
        <form class="form-inline">
       <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role'])){ 
         $role = $_SESSION['role']; 
         if($role=="1"){?>
          <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="logout"> Logout</a>
          <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="admin"> Admin Panel</a>
          <?php }elseif($role=="2"){ ?>
            <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="logout"> Logout</a>
            <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="admin"> Editor Panel</a>
            <?php } elseif($role=="3"){?>
              <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="logout"> Logout</a>
              <?php } ?>
          <?php }else { ?>
            <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="register" margin-right="5px"> Sign Up</a>
					  <a class="btn btn-outline-secondary btn-sm ml-2" role="button" href="login"> Login</a>
         <?php } ?>
				</form>
      </div>
    </nav>