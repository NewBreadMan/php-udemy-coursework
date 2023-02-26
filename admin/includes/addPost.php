<?php

if(isset($_POST['create_post'])){
                          
    $post_title      = $_POST['post_title']; 
    $post_author     = $_POST['post_author'];                            
    $post_category_id = $_POST['post_category']; 
    $post_status     = "unapproved";                          
    $post_image      = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags       = $_POST['post_tags'];
    $post_content    = $_POST['post_content'];
    $post_views      = 0;
    //$post_comment_ct = 0;
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image" );

    $query = "INSERT INTO posts(post_category_id, post_title, post_views_ct, post_author, posted_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES( '{$post_category_id}', '{$post_title}', {$post_views}, '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";
    $add_post_qry = mysqli_query($connx, $query);
    confirmQuery($add_post_qry);
    $post_id = mysqli_insert_id($connx);

    echo "<p class='bg-success'> Post was created.  <a href='../post.php?p_id={$post_id}'> View this Post </a> or <a href='posts.php' >Edit other posts</a></p>";
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
     <select name="post_category" id="post_category">
        <?php 
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
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
            <option value="draft">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
        </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10">
        </textarea>
    </div>

    <div class="form-gourp">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</form>