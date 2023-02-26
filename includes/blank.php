<?php
$password = "NimdaYorel"; // Usually from a form
$cost = "2y$10$";
$hashphrase = "MenomoneeFalls2newhome";
$salt = $cost . $hashphrase;
// Initializing Values
$old_password = crypt($password, $salt);
$new_password = crypt($password, $old_password);
echo $new_password;
echo "<br>";
echo $old_password;
echo "<br>";
if($old_password !== $new_password){ 
    echo "does not match";
}else{
    echo "they match";
}

?>