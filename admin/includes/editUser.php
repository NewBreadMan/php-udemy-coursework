<?php
if(isset($_GET['edit_user'])){
   $user_id = $_GET['edit_user'];
    //~~~~~~  capture dB data into vars.
    $query = "SELECT * FROM users WHERE user_id = $user_id ";
      $editUserQry = mysqli_query($connx, $query);
            confirmQuery($editUserQry);
      while($row = mysqli_fetch_assoc($editUserQry)) {
          //assign user data from table 'users' to vars...
       $username        = $row['username'];                           
       $user_fname      = $row['user_firstname'];
       $user_lname      = $row['user_lastname'];
       $db_user_email   = $row['user_email'];                          
       $db_user_image   = $row['user_image'];                           
       $user_role       = $row['user_role'];
       $userOrigin_date = $row['user_created_on'];
       $user_pw         = $row['user_pw'];
       $salt            = $row['randSalt'];
      }
    }

  //pull the data from the form into vars...
if(isset($_POST['edit_user'])){    
    //data from the form, stored in variables...
    $username       = $_POST['username'];        
    $user_fname     = $_POST['user_fname']; 
    $user_lname     = $_POST['user_lname'];
    $user_role      = $_POST['user_role'];   
    $user_email     = $_POST['user_email'];                   
    $user_image     = $_FILES['user_image']['name'];
    $user_img_temp  = $_FILES['user_image']['tmp_name'];
    $user_pw        = $_POST['user_pw'];

    //get the randSalt from the dB, for inclusion in the crypt function...
    $saltqry = mysqli_query($connx, "SELECT randSalt FROM users");
        confirmQuery($saltqry);
    $row = mysqli_fetch_array($saltqry);
    $salt = $row['randSalt'];

     //clean up what was entered on the form...
     $username = mysqli_real_escape_string($connx, $username); 
     $user_fname = mysqli_real_escape_string($connx, $user_fname); 
     $user_lname = mysqli_real_escape_string($connx, $user_lname);
     $user_pw = mysqli_real_escape_string($connx, $user_pw);

        $hashed_pw = crypt($user_pw, $salt);

         if(!empty($db_user_image)) {
           $user_image = $db_user_image;
      }
       move_uploaded_file($user_img_temp, "../images/$user_image" );

 
   $query = "UPDATE users SET ";
   $query .= "username = '{$username}', ";
   $query .= "user_firstname = '{$user_fname}', ";
   $query .= "user_lastname = '{$user_lname}', ";
   $query .= "user_role = '{$user_role}', ";
   // $query .= "user_pw = '{$hashed_pw}', " ;
   $query .= "user_image = '{$user_image}', ";
   $query .= "user_email = '{$user_email}' ";
   $query .= "WHERE user_id = {$user_id} ";
    
   $editUserQry = mysqli_query($connx, $query);
    confirmQuery($editUserQry);
    echo "<p class='bg-success'> User was updated.  <a href='users.php' >View All Users? </a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
     <select name="user_role" id="user_role">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>        
             <?php 
             if($user_role == 'admin'){
                 echo "<option value='subscriber'>subscriber</option>";
             } else {
                echo "<option value='admin'>Admin</option>";
             } ?>
     </select>
    </div>

    <div class="form-group">
        <label for="user_fname"> First Name</label>
        <input type="text" value="<?php echo $user_fname; ?>" class="form-control" name="user_fname">
    </div>

    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text"  value="<?php echo $user_lname; ?>" class="form-control" name="user_lname">
    </div>

    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email"  value="<?php echo $db_user_email; ?>" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
      <img src="../images/<?php echo '{$user_image}';?>" width="100" alt="">
    </div>

    <!-- <div class="form-group">
        <label for="user_pw">Password</label>
        <input type="password" value="<?php // echo $user_pw; ?>" class="form-control" name="user_pw">
    </div> -->

     <div class="form-gourp">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

</form>