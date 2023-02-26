<?php include "db.php"?>
<?php session_start(); ?>

<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $pw = $_POST['password'];

    $username = mysqli_real_escape_string($connx, $username);
    $pw = mysqli_real_escape_string($connx, $pw);
        
    //pull data from dB to compare details...
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $verifyUserQry = mysqli_query($connx, $query);

          // process the data to vars storage...
    while($row = mysqli_fetch_array($verifyUserQry)) {
        $db_user_id     = $row['user_id'];
        $db_user_pw     = $row['user_pw'];
        $db_username    = $row['username'];
        $db_user_fname  = $row['user_firstname'];
        $db_user_lname  = $row['user_lastname'] ;
        $db_user_role   = $row['user_role'];
        $db_user_email  = $row['user_email'];
        $db_user_image  = $row['user_image'];     
    }

    //~~~~~~~~~then, decrypt the db_password data in order to compare with what was entered...  it acts on $pw from form & $db_user_pw from dB
    $recrypt_pw = crypt($pw, $db_user_pw);   

    //~~~~~~~check if both are correct matches...   
    if($username === $db_username && $recrypt_pw === $db_user_pw) {

        //~~~~~~ if so, pipe db data --> Session_variables!~~~~~~
        $_SESSION['username']   = $db_username;
        $_SESSION['firstname']  = $db_user_fname;
        $_SESSION['lastname']   = $db_user_lname;
        $_SESSION['role']       = $db_user_role;
        $_SESSION['email']      = $db_user_email;
        header("Location: ../admin");
        
           // else, the password didn't match....do a page refresh!!!
    } else {
                header("Location: ../index.php");
        }
    
}
    
?>

