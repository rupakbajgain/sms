<?php
$p = "<h6>".$_GET['p']."</h6>";
if($p!="<h6></h6>"){
echo $p;
}
?>
<?php if(isset($_SESSION['UID'])){?>
<hr/>
<a href = "./"><div class = "as">Home</div></a>
<a href = "changepassword.php"><div class = "as">Change password</div></a>
<a href = "logout.php"><div class = "as">logout (<?= $_SESSION['UID'] ?>)</div></a>
<?php } ?>
<a href = "feedback.php"><div class = "as">Feedback</div></a>
<pre>
<?php
date_default_timezone_set('Asia/Kathmandu');
echo "Current time:";
echo date("h:i:s a");
echo "\nCurrent date:";
$tod = date("Y/m/d");
echo $tod;
if ($_SESSION['p']>0){
echo "\nNumber of SMS left:";
$result = mysql_query("SELECT V FROM dtable_uinfo WHERE F='ldate';",$db);
if($tod!=mysql_fetch_array($result)[0]){
$result = mysql_query("SELECT V FROM dtable_uinfo WHERE F='total_num';",$db);
echo (mysql_fetch_array($result)[0]+1)*10;
}else{
$result = mysql_query("SELECT V FROM dtable_uinfo WHERE F='tot_rem';",$db);
echo mysql_fetch_array($result)[0];
}

}
?>
</pre>
</body>
</html>
<?php
mysql_close($db);
?>
