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

}

    $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
    $select_posts_qry = mysqli_query($connx, $query);
    while($row = mysqli_fetch_array($select_posts_qry)) {
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
        Dummy Blogs for Coursework
        <small>by student</small>
        </h1>

    <!-- Blog Posts  -->
    <h2>
        <a href="#"><?php echo $post_title; ?></a>
    </h2>
    <p class="lead">
        by <a href="#"><?php echo $post_author; ?></a>
    </p>
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

  <!----------------Blog Comments -->
     <!--------------- Comments Form -->
        <div class="well">
            <h3>Leave a Comment:</h3>
            <form role="form" action="" method="post"> 
                <div class="form-group">
                    <label for="comment_author">Author</label>
                    <input type="text" class="form-control" name="comment_author"> 
                </div>

                <div class="form-group">
                    <label for="comment_email">Author's Email</label>
                    <input type="email" class="form-control" name="comment_email">  
                </div>
                
                <div class="form-group">
                    <label for="comment">Comment</label>
                <textarea class="form-control"name="comment_content" rows="3"></textarea>
               </div>

               <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
            </form>
        </div>
        <h3>Approved Comments</h3><br>

                <!-- Posted Comments -->

<?php 
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC" ;

        $showCommentsQry = mysqli_query($connx, $query);
        if(!$showCommentsQry) {
            die("something went wrong." . mysqli_error($connx));
        }
        while( $row = mysqli_fetch_array($showCommentsQry)) {
            $comment_date       = $row['comment_date'];
            $comment_content    = $row['comment_content'];
            $comment_author     = $row['comment_author'];
            $comment_email      =$row['comment_email'];
            ?>
         <!--~~~~~~~~~~~~~~~Comments~~~~~~~~~~~~~~~~~~~
          "https://via.placeholder.com/900x300"  --->
         
         <div class="media">
            <a class="pull-left" href="#">        </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author;?><small>  ...wrote on:   <?php echo $comment_date; ?></small></h4>
                <?php echo $comment_content; ?>
            </div>
        </div>
       <?php 
         echo "Contact the author at:  " . $comment_email ; 
         } ?>
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
