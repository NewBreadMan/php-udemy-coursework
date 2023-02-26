<?php include "includes/header.php"; ?>
<?php include "includes/dB.php";?>
<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
<!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
  $p_page = 4;  //hard-coded 'posts per page' variable
  if(isset($_GET['page'])){
      $page_num = $_GET['page'];
  }else{
      $page_num = "";
  }

  if($page_num == "" || $page_num == 1){
      $page_1 = 0;
  }else{
      $page_1 = ($page_num * $p_page)-$p_page;
  }
      echo "this is page number " . $page_num;
    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
    $select_posts_qry = mysqli_query($connx, $query);

    while($row = mysqli_fetch_array($select_posts_qry)) {
        $post_id        = $row['post_id'];
        $post_cat_id    = $row['post_category_id'];
        $post_title     = $row['post_title'];
        $post_views_ct  = $row['post_views_ct'];
        $post_author    = $row['post_author'];
        $post_date      = $row['posted_date'];
        $post_image     = $row['post_image'];
        $post_content   = substr($row['post_content'],0,96);
        $post_tags      = $row['post_tags'];
        $comment_count  = $row['post_comment_count'];
        $post_status    = $row['post_status']; 

        if($post_status == 'published'){
    

        ?>
        <h1 class="page-header">
        Dummy Blogs for Coursework
        <small>by student</small>
        </h1>

    <!-- Blog Posts  -->
    <h2>
    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
    </h2>
    <p class="lead">
        by <a href="authorPosts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author; ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
    <p><h4> <?php echo "This is post #:  " . $post_id; ?></h4></p>
    <hr>

    <a href="post.php?p_id=<?php echo $post_id; ?>">
    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
    </a>

    <hr>
    <p><?php echo $post_content; ?></p>
    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
   

    <hr>
    <hr>
    <!-- Pager -->
    <ul class="pager">
        <li class="previous">
            <a href="#">&larr; Older</a>
        </li>
        <li class="next">
            <a href="#">Newer &rarr;</a>
        </li>
    </ul>

 <?php 
     }
    }
?>
     </div>

            <!-- Blog Sidebar Widgets Column -->
          
<?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->
<!-- end  Blog Sidebar Widgets Column -->
        <hr>

        <!-- Footer -->
 <?php include "includes/footer.php"; ?>

    </div>


</body>

</html>
