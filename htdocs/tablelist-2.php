<?php
include "head.php";
include "header.php";
minPrivilage(2);
include "functions/connection.php";
include "functions/users.php";
if(isset($_GET['retid'])){
$_GET['retid'] = mysql_escape_string($_GET['retid']);
mysql_query("INSERT INTO table_link(userid,tableid) VALUES ('".$_GET['retid']."','".$_GET['id']."');",$db);
$_GET['p'] = "Added to user sucessfully.";
}

if(isset($_GET['dtableid'])){
$did=mysql_escape_string($_GET['dtableid']);
$dud=mysql_escape_string($_GET['duserid']);
mysql_query("DELETE FROM table_link WHERE tableid=$did AND userid=$dud;",$db);
$_GET['p'] = "Deleted sucessfully.";
}

if(isset($_POST['ntn'])){
include "functions/tables.php";
$t = new tables;
$t->addNew($_POST['ntn']);
}
?>
<table width='100%' class='main'>
<tr><th>Name</th><th>Action</th><th>Remove link from</th></tr>
<?php
$result = mysql_query("SELECT id,name FROM tables;",$db);
while($myrow = mysql_fetch_array($result)){
echo "<tr><td>";
echo $myrow['name'];
echo "</td><td>";
echo "<a href='userlist-2.php?p=Select+user+to+add+table+to.&ret=tablelist-2&dupid=".$myrow['id']."'>Add new user</a>";
echo "</td><td>";

$result2 = mysql_query("SELECT userid FROM table_link WHERE tableid=".$myrow['id'].";",$db);
$u = new users;
while($myrow2 = mysql_fetch_array($result2)){
$name = $u->getNameFromId($myrow2['userid']);
echo "<a href='tablelist-2.php?dtableid=".$myrow['id']."&duserid=".$myrow2['userid']."'>$name</a><br/>";
}

echo "</td></tr>";
}

echo "</table>";
?>
<br>
<form method="post" action="tablelist-2.php">
New table name:<input name="ntn"/><input value="Create table" type="Submit">
</form>
<?php
include "footer.php";
?>
