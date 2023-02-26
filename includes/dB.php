<?php  //~~~~~~~cms/includes/dB.php~~~last revised 11/7/22~~~
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_NAME", 'cms');


$connx = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($connx) {
        // echo "We  are connected";
}
?>