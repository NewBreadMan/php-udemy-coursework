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


if(isset($_GET['p_id'])) {
$post_id = $_GET['p_id'];
$post_author = $_GET['author'];
}

    $query = "SELECT * FROM posts WHERE post_author = '{$post_author}' ";
    $selectPostsByAuthorQry = mysqli_query($connx, $query);
    while($row = mysqli_fetch_array($selectPostsByAuthorQry)) {
        $post_id        = $row['post_id'];
        $post_cat_id    = $row['post_category_id'];
        $post_title     = $row['post_title'];
        $post_views_ct  = $row['post_views_ct'];
        $post_author    = $row['post_author'];
        $post_date      = $row['posted_date'];
        $post_image     = $row['post_image'];
        $post_content   = $row['post_content'];
        $post_tags      = $row['post_tags'];
        $comment_count  = $row['post_comment_count'];
        $post_status    = $row['post_status']; 

        ?>
        <h1 class="page-header">
        Dummy Blogs for Coursework  </h1>
        <p><h3>All posts by: <?php echo $post_author; ?></h3></p>
       

    <!-- Blog Posts  -->
    <h2>
    <p class="lead">
        
    </p>
        <a href="#"><?php echo $post_title; ?></a>
    </h2>
    
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
    <p><h4> <?php echo "This is post #:  " . $post_id; ?></h4></p>
    <hr>
    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
    <hr>
    <p><?php echo $post_content; ?></p>
   
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
?>
<?php
    if(isset($_POST['create_comment'])){
       $post_id = $_GET['p_id'];

       $comment_author  = $_POST['comment_author'];
       $author_email    = $_POST['comment_email'];
       $comment         = $_POST['comment_content'];
//~~~~~~~~~~validate data entered~~~~~~~~~~~~
       $comment_author = mysqli_real_escape_string($connx, $comment_author);
       $author_email = mysqli_real_escape_string($connx, $author_email);
       $comment = mysqli_real_escape_string($connx, $comment);

        if(!empty($comment_author) && !empty($author_email) && !empty($comment)){

        $query = "INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_email, comment_content, comment_status) ";
        $query .= "VALUES ({$post_id}, now(), '{$comment_author}', '{$author_email}', '{$comment}', 'Unapproved')";
    
        $add_commentQry = mysqli_query($connx, $query);
        if(!$add_commentQry){
            die("something went wrong. Investigate it!  ". mysqli_error($connx));
        }
        //~~~~~increment commment counts for the respective post when new comment is added~~~~
        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id" ;
        $updateCommentCtQry = mysqli_query($connx, $query);
     }else{
         echo "<script>alert('These fields CANNOT be empty!')</script>";
     }
    }
?>

    <br>
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
