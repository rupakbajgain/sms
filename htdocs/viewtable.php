<?php
include "head.php";
include "header.php";
minPrivilage(1);
include "functions/connection.php";
include "functions/tables.php";
$_GET['id']=mysql_escape_string($_GET['id']);

$result = mysql_query("SELECT tableid FROM table_link WHERE userid='".$_SESSION['ID']."' AND tableid='".$_GET['id']."';",$db);
$tid=mysql_fetch_array($result)[0];

$t = new tables;
$tn = $t->getNameFromId($tid);

if(isset($_POST['ncn']) and $_POST['ncn']!=""){
$_POST['ncn']=mysql_escape_string($_POST['ncn']);
mysql_query("alter table dtable_$tn add column ".$_POST['ncn']." VARCHAR(255);",$db);
$_GET['p']="Column added sucessfully.";
}

if(isset($_GET['addrow'])){
mysql_query("insert into dtable_$tn() values();",$db);
$_GET['p']="Row added sucessfully.";
}

if(isset($_GET['delcol'])){
$_GET['delcol']=mysql_escape_string($_GET['delcol']);
mysql_query("alter table dtable_$tn drop column ".$_GET['delcol'].";",$db);
$_GET['p']="Column deleted sucessfully.";
}

if(isset($_GET['delrow'])){
$_GET['delrow']=mysql_escape_string($_GET['delrow']);
mysql_query("delete from dtable_$tn where id = '".$_GET['delrow']."';",$db);
$_GET['p']="Row deleted sucessfully.";
}

if(isset($_GET['editcol'])){
$_GET['editrow']=mysql_escape_string($_GET['editrow']);
$_GET['editcol']=mysql_escape_string($_GET['editcol']);
$_POST['t']=mysql_escape_string($_POST['t']);
mysql_query("update dtable_$tn set ".$_GET['editcol']."='".$_POST['t']."' where id='".$_GET['editrow']."';",$db);
$_GET['p']="Data edited sucessfully.";
}

echo "<center><h2>$tn</h2></center>";

echo "<table class='main'>";
$result = mysql_query("SHOW COLUMNS FROM dtable_$tn;",$db);
$rc=0;
$rows = array();
echo "<tr>";
while($myrow=mysql_fetch_array($result)){
array_push($rows,$myrow['Field']);
if($rc==0){
echo "<th>Option</th>";
}else{
echo "<th>".$myrow['Field']."<br><a href='viewtable.php?id=$tid&delcol=".$myrow['Field']."'>Delete</a></th>";
}
$rc++;
}
echo "</tr>";

$result = mysql_query("SELECT * FROM dtable_$tn;",$db);
while($myrow=mysql_fetch_array($result)){
echo "<tr>";
for($i=0;$i<$rc;$i++){
if($i==0){
$myrow[$i]="<a href='viewtable.php?id=$tid&delrow=".$myrow['id']."'>Delete</a>";
}else{
$myrow[$i] = "<form method='post' action='viewtable.php?id=$tid&editcol=".$rows[$i]."&editrow=".$myrow['id']."'><input value='".$myrow[$i]."' name='t'><input type='Submit' value='Ok'></form>";
};
echo "<td>".$myrow[$i]."</td>";
}
echo "</tr>";
}

echo "</table>";
?>
<br>
<a href = "viewtable.php?addrow&id=<?= $tid?>"><input class = "login" value = "Add new row" type = "button"></a>
<form method = "post" action="viewtable.php?id=<?= $tid?>">
New column name:
<input name="ncn">
<input type="Submit" value="Add column">
</form>
<?php
include "footer.php";
?>
