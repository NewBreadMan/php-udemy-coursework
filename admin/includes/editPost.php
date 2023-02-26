<?php
    if(isset($_GET['p_id'])){
      $post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $editPostQuery = mysqli_query($connx, $query);

      while($row = mysqli_fetch_assoc($editPostQuery)) {
       //~~~Assign table data to variables~~~~~
       $post_author    = $row['post_author'];                           
       $post_title     = $row['post_title'];                          
       $post_cat_id    = $row['post_category_id'];                           
       $post_content    = $row['post_content'];
       $post_status     = $row['post_status'];
       $post_image      = $row['post_image'];
       $post_tags       = $row['post_tags'];
       $post_comment_ct = $row['post_comment_count'];
      }

      if(isset($_POST['update_post'])){
          //~~~~~Assign form's fieldnames' data to variables~~~~~
        $post_title      = $_POST['post_title']; 
        $post_author     = $_POST['author'];                            
        $post_cat_id     = $_POST['post_category']; 
        $post_status     = $_POST['post_status'];                          
        $post_image      = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags       = $_POST['post_tags'];
        $post_content    = $_POST['post_content'];
       
        move_uploaded_file($post_image_temp, "../images/$post_image" );
        if(empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $image_qry = mysqli_query($connx, $query);
            while($row = mysqli_fetch_array($image_qry)) {
                $post_image = $row['post_image'];
            }
        }
            //~~~~Use form fieldnames to insert into table data~~~~
            $query =    "UPDATE posts SET ";
            $query .=   "post_category_id = {$post_cat_id}, ";
            $query .=   "post_title =  '{$post_title}', ";
            $query .=   "post_author =  '{$post_author}', ";
            $query .=   "post_image = '{$post_image}', ";
            $query .=   "post_content =  '{$post_content}', ";
            $query .=   "post_tags =  '{$post_tags}', ";
            $query .=   "post_status = '{$post_status}' ";
            $query .=   "WHERE post_id = {$post_id} ";

            $update_post_qry = mysqli_query($connx, $query);
            confirmQuery($update_post_qry);

        echo "<p class='bg-success'> Post was updated.  <a href='../post.php?p_id={$post_id}'> View this Post </a> or <a href='posts.php' >Edit other posts</a></p>";
       }
      
?>

<form action="" method="post" enctype="multipart/form-data">
  <!-- echo the table variables to the form's fields ~~~~ -->
    <h5> <?php echo $post_id . " = this post's ID"; ?></h5>
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>

        <select name="post_category" id="post_category">
<?php //~~~~~Query listing of categories to show them in the form~~~~~~~~~~~
        $query = "SELECT * FROM categories ";
        $category_qry = mysqli_query($connx, $query);    
        confirmQuery($category_qry);

        while($row = mysqli_fetch_array($category_qry)) {
            $cat_title      = $row['cat_title'];
            $post_cat_id    = $row['cat_id'];

        echo "<option value='$post_cat_id'>{$cat_title}</option>";
        }   
?>
         </select>
    </div>

    <div class="form-group">
        <label for="author"> Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
    <select name="post_status" id="">
        <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
    <?php
        if($post_status == 'published'){
            echo "<option value='draft'>Draft</option>";
        }else{
            echo "<option value='published'>Publish</option>";
        }
    ?>
    </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
      <img src="../images/<?php echo $post_image ;?>" width="175" alt="">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-gourp">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>