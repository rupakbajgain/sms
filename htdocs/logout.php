<?php
session_start();
session_destroy();
session_write_close();
header("Location: login.php?p=You+logged+out+sucessfully.");
?>
