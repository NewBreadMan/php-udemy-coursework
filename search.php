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

    if(isset($_POST['submit'])){
    $search_word = $_POST['search']; 

    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_word%'";
        $post_tagword_search = mysqli_query($connx, $query);
        if(!$post_tagword_search){
            die("post_tag search failed. ". mysqli_error($connx));
        }else{
            while($row = mysqli_fetch_array($post_tagword_search)) {
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
    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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
