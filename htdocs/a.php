<?php
include "head.php";
include "header.php";
include "functions/connection.php";
?>
<?php
if ($_SESSION['p']==0){
?>
To do...<br>
This page is under construction, please visit later.
<?php
};
if ($_SESSION['p']>0){
?>
<?php
include "functions/tables.php";
$t = new tables;
$result = mysql_query("SELECT tableid FROM table_link WHERE userid=".$_SESSION['ID'].";",$db);
while($myrow = mysql_fetch_array($result)){
$ts = $t->getNameFromId($myrow[0]);
echo "<a href='viewtable.php?id=$myrow[0]'><div class = 'as'>View table ($ts)</div></a>";
}
echo '<hr><a href = "sendmessage.php"><div class = "as">Send Message</div></a>';
if ($_SESSION['p']>1){
?>
<hr>
<a href = "userlist-2.php"><div class = "as">User list</div></a>
<a href = "tablelist-2.php"><div class = "as">Table list</div></a>
<a href = "cookielogin-2.php"><div class = "as">Cookie login</div></a>
<a href = "sendsms-2.php"><div class = "as">Send SMS to anyone.</div></a>
<?php
if ($_SESSION['p']>2){
?>
<hr>
<a href = "executesql-3.php"><div class = "as">Execute sql command.</div></a>
<?php
}
}
}
?>
<?php
include "footer.php";
?>
