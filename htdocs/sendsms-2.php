<?php
include "head.php";
include "header.php";
minPrivilage(2);
include "functions/connection.php";

if(isset($_GET['msg'])){
include "functions/message.php";

$req = requestMessages(1);
sendMessage($req[$i][0],$_GET['num'],$_GET['msg']);

header("Location: ./?p=Feedback+sent.");
}
?>
<form method="get" action="sendsms-2.php">
<h2>Feedback</h2>
Number:<input name="num">
<br>Message:<br>
<textarea name = "msg"></textarea>
<input type = "submit" value = "Send"><hr>
</form>
<?php
include "footer.php";
?>
