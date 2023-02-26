<table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Responding To</th>
                    <th>Date</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Comment Count</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
           </thead>
            <tbody>
<?php                                
      $query = "SELECT * FROM comments";
      $commentsQuery = mysqli_query($connx, $query);

      while($row = mysqli_fetch_assoc($commentsQuery)) {
       $comment_id          = $row['comment_id'];
       $commentPostID       = $row['comment_post_id'];                           
       $comment_date        = $row['comment_date'];
       $comment_content     = $row['comment_content'];
       $comment_author      = $row['comment_author'];                          
       $comment_email       = $row['comment_email'];                           
       $comment_count       = $row['comment_count'];
       $comment_status      = $row['comment_status'];
      
            echo "<tr>";
          
          $query = "SELECT * FROM posts WHERE post_id = $commentPostID ";
          $comment_qry = mysqli_query($connx, $query);    
      
                while($row = mysqli_fetch_array($comment_qry)) {
                    $post_title       = $row['post_title'];
                    $post_id          = $row['post_id'];
                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                }
         
          echo "<td>{$comment_date}</td>";
          echo "<td>{$comment_content}</td>";
          echo "<td>{$comment_author}</td>";
          echo "<td>{$comment_email}</td>"; 
          echo "<td>{$comment_status}</td>";
          echo "<td>{$comment_count}</td>";
          echo "<td><a href='comments.php?Approve={$comment_id}'>Approve</a></a></td>";
          echo "<td><a href='comments.php?Unapprove={$comment_id}'>Unapprove</a></td>";
          echo "<td><a href='comments.php?source=Edit comment&p_id={$comment_id}'>Edit</a></a></td>";
          echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this comment?');\" href='comments.php?Delete={$comment_id}'>Delete</a></td>";
          echo "</tr>";
      }                                           
?>                       
           </tbody>
         </table>

   <?php //~~~~~~~~~~Change approval status of a Comment~~~~~
   if(isset($_GET['Approve'])){
    $comment_id = $_GET['Approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
    $updateStatusQry = mysqli_query($connx, $query);
    header("Location: comments.php");
   }

   if(isset($_GET['Unapprove'])){
    $comment_id = $_GET['Unapprove'];
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$comment_id}";
    $updateStatusQry = mysqli_query($connx, $query);
    header("Location: comments.php");
   }
   //~~~~~~~~~~Delete a Comment~~~~~
   if(isset($_GET['Delete'])){
    $comment_id = $_GET['Delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
    $deleteCommentQry = mysqli_query($connx, $query);
    header("Location: comments.php");
   }

   ?> 