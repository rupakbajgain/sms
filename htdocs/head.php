<?php
session_start();
if(!isset($_SESSION["UID"])){
header("Location: login.php?p=".$_GET['p']);
}

function minPrivilage($p){
if($_SESSION['p']<$p)header('Location: ./');
};

?>
