<?php

if(isset($_POST['add_user'])){
                          
    $username       = $_POST['username']; 
    $user_role      = $_POST['user_role'];                            
    $user_fname     = $_POST['user_fname']; 
    $user_email     = $_POST['user_email'];
    $user_lname     = $_POST['user_lname'];                     
    $user_image      = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_pw        = $_POST['user_pw'];
    $new_user_date = date('d-m-y');

    move_uploaded_file($user_image_temp, "../images/$user_image" );

    $query = "INSERT INTO users(username, user_role, user_firstname, user_lastname, user_email, user_image, user_pw, user_created_on) ";   
    $query .= "VALUES('{$username}', '{$user_role}','{$user_fname}', '{$user_lname}', '{$user_email}', '{$user_image}', '{$user_pw}', now() )";
    $addUserQry = mysqli_query($connx, $query);
        confirmQuery($addUserQry);
     echo "User was created: " . " " . "<a href='users.php'>View Users</a>";   
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>

     <select name="user_role" id="user_role">
            <option value="subscriber">Select Option</option>        
             <option value="subscriber">subscriber</option>
             <option value="Admin">Admin</option>
     </select>
    </div>


    <div class="form-group">
        <label for="user_fname"> First Name</label>
        <input type="text" class="form-control" name="user_fname">
    </div>

    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text" class="form-control" name="user_lname">
    </div>

    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="user_pw">Password</label>
        <input type="password" class="form-control" name="user_pw">
    </div>

     <div class="form-gourp">
        <input class="btn btn-primary" type="submit" name="add_user" value="Create New User">
    </div>

</form>