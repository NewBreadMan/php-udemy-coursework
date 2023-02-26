<?php
    if(isset($_POST['checkboxArray'])){
        foreach($_POST['checkboxArray'] as $postIDValue){
            $bulkOptions = $_POST['bulk_options'];  //the container in front of each row...(?)
            switch($bulkOptions){
                case 'published' :
                    $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = $postIDValue";
                    $bulkUpdateQry = mysqli_query($connx, $query);
                    confirmQuery($bulkUpdateQry);
                break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = $postIDValue";
                    $bulkUpdateQry = mysqli_query($connx, $query);
                    confirmQuery($bulkUpdateQry);
                break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $postIDValue";
                    $bulkUpdateQry = mysqli_query($connx, $query);
                    confirmQuery($bulkUpdateQry);
                break;
            }     
        }
    } 
?>

<form action="" method="post">

<table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-3">

        <select class="fomr-control" name="bulk_options" id="bulkOptionsContainer">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=Add Post"> Add New Post </a>
    </div>

            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAllBoxes"</th>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Posted Date</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Number of views</th>
                    <th>Comment Counts</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php                                
      $query = "SELECT * FROM posts";
      $postsQuery = mysqli_query($connx, $query);

      while($row = mysqli_fetch_assoc($postsQuery)) {
       $post_id             = $row['post_id'];
       $post_author         = $row['post_author'];                           
       $post_title          = $row['post_title'];
       $post_date           = $row['posted_date'];                          
       $post_category_id   = $row['post_category_id'];                          
       $post_content        = $row['post_content'];
       $post_status         = $row['post_status'];
       $post_image          = $row['post_image'];
       $post_tags           = $row['post_tags'];
       $post_views          = $row['post_views_ct'];
       $post_comment_ct     = $row['post_comment_count'];
       $post_date           = $row['posted_date'];
      
        echo "<tr>";

        ?>
        <td><input type="checkbox" class="checkboxes" name="checkboxArray[]" value="<?php echo $post_id;?>"</td>

        <?php
          echo "<td>{$post_id}</td>";
          echo "<td>{$post_author}</td>";
          echo "<td>{$post_title}</td>";
          echo "<td>{$post_date}</td>";

          $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
          $category_qry = mysqli_query($connx, $query);    
      
                while($row = mysqli_fetch_array($category_qry)) {
                    $cat_title = $row['cat_title'];
                    $cat_id    = $row['cat_id'];
                }
          echo "<td>{$cat_title}</td>";  //was category_id or post_cat_id...
          echo "<td>{$post_content}</td>";
          echo "<td>{$post_status}</td>";
          echo "<td><img width='150' src='../images/$post_image' alt='image'></td>";
          echo "<td>{$post_tags}</td>";
          echo "<td>{$post_views}</td>";
          echo "<td>{$post_comment_ct}</td>";
          echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
          echo "<td><a href='posts.php?source=Edit Post&p_id={$post_id}'>Edit</a></a></td>";
          echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='posts.php?Delete={$post_id}'>Delete</a></td>";
          echo "</tr>";
      } 
                                                          
      
?>                       
           </tbody>
         </table>

   <?php //~~~~~~~~~~Delete a Post~~~~~
   if(isset($_GET['Delete'])){
    $post_id = $_GET['Delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id}";
    $deletePostQry = mysqli_query($connx, $query);
    header("Location: posts.php");
   }
   ?> 