<?php
include "functions/connection.php";
include "functions/users.php";
$u = new users;

if ($u->isValid($_POST['name'],$_POST['password'])){
session_start();
$_SESSION['UID']=$_POST['name'];
$_SESSION['ID']=$u->getIdFromName($_POST['name']);
$_SESSION['p']=$u->getPrivilageFromId($_SESSION['ID']);
session_write_close();
header("Location: a.php?p=You+are+now+logged+in.");
}else{
header("Location: login.php?p=Wrong+username+or+password.Try+Again.");
};

?>
