<?php
include "functions/connection.php";
include "functions/users.php";

$u = new users;
echo ".";
$id=$u->getIdFromName($_POST['name']);

if($id == 0){
$u->addNew($_POST['name'],$_POST['password']);
header("Location: feedback.php?p=Sucessfully+registered.+Log+in+to+continue.&msg=...".$_POST['name']."...");
}else{
header("Location: register.php?p=The+user+already+exists.");
};


mysql_close($db);
?>

