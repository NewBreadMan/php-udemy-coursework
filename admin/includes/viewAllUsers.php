
<table class="table table-bordered table-hover">
  
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Email</th>
                    <th>User Image</th>
                    <th>User Role</th>
                    <th>Created On</th>
                    <th>Admin</th>
                    <th>subscriber</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
           </thead>
            <tbody>
<?php                                
      $query = "SELECT * FROM users";
      $usersQuery = mysqli_query($connx, $query);

      while($row = mysqli_fetch_assoc($usersQuery)) {
       $user_id         = $row['user_id'];
       $user_pw         = $row['user_pw'];
       $username        = $row['username'];                           
       $user_fname      = $row['user_firstname'];
       $user_lname      = $row['user_lastname'];
       $user_email      = $row['user_email'];                          
       $user_image      = $row['user_image'];                           
       $user_role       = $row['user_role'];
       $user_created_on = $row['user_created_on'];
       $rand_salt       = $row['randSalt'];
      
          echo "<tr>";         
          echo "<td>{$username}</td>";
          echo "<td>{$user_fname}</td>";
          echo "<td>{$user_lname}</td>";
          echo "<td>{$user_email}</td>"; 
          echo "<td>{$user_image}</td>";
          echo "<td>{$user_role}</td>";
          echo "<td>{$user_created_on}</td>";
          echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";
          echo "<td><a href='users.php?subscriber={$user_id}'>subscriber</a></td>";
          echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
          echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?');\" href='users.php?Delete={$user_id}'>Delete</a></td>";
          echo "</tr>";
      }                                           
?>                       
           </tbody>
         </table>
    </form>
   <?php //~~~~~~~~~~Change role of a User~~~~~
   if(isset($_GET['admin'])){
    $user_id = $_GET['admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
    $updateStatusQry = mysqli_query($connx, $query);
    header("Location: users.php");
   }

   if(isset($_GET['subscriber'])){
    $user_id = $_GET['subscriber'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";
    $updateStatusQry = mysqli_query($connx, $query);
    header("Location: users.php");
   }
   //~~~~~~~~~~Delete a User~~~~~
   if(isset($_GET['Delete'])){
    $comment_id = $_GET['Delete'];
    $query = "DELETE FROM users WHERE user_id = {$user_id}";
    $deleteUserQry = mysqli_query($connx, $query);
    header("Location: users.php");
   }

   ?> 