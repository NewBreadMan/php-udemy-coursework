<?php include "db.php"?>
<?php session_start(); ?>

<?php
  $_SESSION['username'] = null;
  $_SESSION['firstname'] = null;
  $_SESSION['lastnane'] = null;
  $_SESSION['role'] = null;
  header("Location: ../index.php");
//session_destroy();

?>

