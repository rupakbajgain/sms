<?php
include "head.php";
include "header.php";
include "functions/connection.php";
include "functions/users.php";
$u = new users;
if(isset($_POST['oldpass'])){
if($u->changePassword($_SESSION['UID'],$_POST['oldpass'],$_POST['newpass'])){
header("Location: ./?p=Password+changed+sucessfully.");
}else{
$_GET['p']="Password do not match.";
}
}
?>
<form action = "changepassword.php" method="post">
Old password:<input type="password" name="oldpass"><br>
New password:<input type="password" name="newpass"><br>
<input type="submit" value="Submit">
</form>
<?php
include "footer.php";
?>
