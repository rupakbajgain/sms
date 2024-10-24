<?php
include "header.php";
include "functions/connection.php";

if(isset($_GET['msg'])){
include "functions/message.php";

$req = requestMessages(1);
if($req!=false){
sendMessage($req[0][0],'9843026034',$_GET['msg']);
}
if(!isset($_GET['p'])){
$_GET['p']="Feedback+sent.";
}

header("Location: ./?p=".$_GET['p']);
}
?>
<form method="get" action="feedback.php">
<h2>Feedback</h2>
Message:<br>
<textarea name = "msg"></textarea>
<input type = "submit" value = "Send"><hr>
</form>
<?php
include "footer.php";
?>
