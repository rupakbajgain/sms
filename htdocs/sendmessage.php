<?php
include "head.php";
include "header.php";
minPrivilage(1);
include "functions/connection.php";

if(isset($_POST['sendto'])){
include "functions/message.php";
if($_POST['sendto']=='Send'){
$sendto = $_POST['sel'];
}else{
$sendto = $_POST['al'];
}

$inm = array();
$result = mysql_query("SELECT id,phone FROM dtable_students;",$db);
while($row=mysql_fetch_array($result)){
	$inm[$row['id']]=$row['phone'];
}

for($i=0;$i<count($sendto);$i++){
	$sendto[$i]=$inm[$sendto[$i]];
};

$req = requestMessages(count($sendto));
if($req==false){
$_GET['p']="Not enough message";
}else{
$cur = 0;
$sa = array();
for($i=0;$i<count($req);$i++){
	$s=array_slice($sendto,$cur,$req[$i][1]);
	$t='';
	for($j=0;$j<count($s);$j++){
		$t.=$s[$j].",";
	}
	date_default_timezone_set('Asia/Kathmandu');
	sendMessage($req[$i][0],rtrim($t,','),$_POST['msg']."\n-".$_SESSION['UID']."(".date("h:i:sa").")");
	$cur+=$req[$i][1];
}

$_GET['p']="Message sent.";
}
}
?>
<form method="post" action="sendmessage.php">
<h2>Send Message</h2>
Message:<br>
<textarea name = "msg"></textarea>
<input type = "submit" name = "sendto" value = "Send to all"><hr>
<?php
$result = mysql_query("SELECT * FROM dtable_students;",$db);
while($myrow=mysql_fetch_array($result)){
echo "<input name = 'sel[]' value='".$myrow['id']."' type='checkbox'>".$myrow['name']."(".$myrow['roll'].")";
echo "<input name = 'al[]' value='".$myrow['id']."' type='hidden'><br>\n";
};
?>
<input type = "submit" name = "sendto" value = "Send"><hr>
</form>
<?php
include "footer.php";
?>