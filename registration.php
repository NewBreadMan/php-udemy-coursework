<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

 <?php
 if(isset($_POST['submit'])){
    //capture form data as vars
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $new_email =  $_POST['email'];
    $new_password = $_POST['password'];

//  ~~~~~clean up the data~~~~~~~~~~~
    $new_username   = mysqli_real_escape_string($connx, $username);
    $new_firstname  = mysqli_real_escape_string($connx, $firstname);
    $new_lastname   = mysqli_real_escape_string($connx, $lastname);
    $new_email      = mysqli_real_escape_string($connx, $new_email);
    $new_password   = mysqli_real_escape_string($connx, $new_password);

    //get randSalt from dB into a var.
    $query = "SELECT randSalt from users";
    $randSaltQry = mysqli_query($connx, $query);
        if(!$randSaltQry) {
            die("Randsalt query failed. " . mysqli_error($connx));
        }
    $row = mysqli_fetch_array($randSaltQry); 
    $salt = $row['randSalt'];

        //confirm the form is completely filled out. if not, don't proceed.
    if(!empty($new_username) && !empty($new_firstname) && !empty($new_lastname) && !empty($new_password) && !empty($new_email)){

     // if so, encrypt the PW before submitting it to dB   
    $new_pw = crypt($new_password, $salt);

    // write it to the dB
    $query = "INSERT INTO users (username, user_firstname, user_lastname,user_email, user_pw, user_role, user_created_on) ";
    $query .= " VALUES ('{$new_username}', '{$new_firstname}','{$new_lastname}','{$new_email}', '{$new_pw}', 'subscriber', now())" ;
    $addNewUserQry = mysqli_query($connx, $query);

    //confirm the query completed correctly.
    if(!$addNewUserQry){
        die("Add new user query failed. " . mysqli_error($connx) . ' ' . mysqli_errno($connx));

    }   // say so, if so
      $message = "Your registration was submitted, with a crypted password of: ". $new_pw ;

    }else{  // else advise about the error to the user.
        $message = "All fields must be completed.";
    }
}else{  //clear the message var if nothing is 'activated', as in first glance.
    $message = "";
} 
?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">
  
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
<!-- ~~~~~~~message: success/failure, or blank on refresh ~~~~~ -->
                        <h5 class="text-center"><?php echo $message;?></h5>
<!--form fields  USERNAME-->
                    <div class="form-group">
                        <label for="username" class="sr-only">username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
<!-- FIRSTNAME-->   <div class="form-group">
                            <label for="firstname" class="sr-only">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your first name">
                        </div>
<!-- LASTNAME-->    <div class="form-group">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your surname">
                        </div>
<!-- EMAIL-->   <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
<!-- PASSWORD -->  <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
