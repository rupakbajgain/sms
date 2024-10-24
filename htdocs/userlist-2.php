<?php
include "head.php";
include "header.php";
minPrivilage(2);
$numPrivilage=3;
include "functions/connection.php";

if(isset($_GET['cid'])){
$cid=$_GET['cid'];
$n = $_GET['n'];
$sid = $_SESSION['p']; 
if($n<=$sid)mysql_query("UPDATE users SET privilage=$n WHERE id=$cid;",$db);
};
?>
<table width='100%' class='main'>
<tr><th>Name</th>
<?php
$result = mysql_query("SELECT id,name,privilage FROM users;",$db);
if(isset($_GET['ret'])){
echo "</tr>";
while($myrow = mysql_fetch_array($result)){
if($myrow['privilage']!=0){
echo "<tr><td>";
echo "<a href='".$_GET['ret'].".php?retid=".$myrow['id']."&id=".$_GET['dupid']."'>".$myrow['name']."</a>";
echo "</td></tr>";
}
}

}else{
echo "<th>Privilage</th></tr>";
while($myrow = mysql_fetch_array($result)){
echo "<tr><td>";
echo $myrow['name'];
echo "</td><td>";
for($i=0;$i<$numPrivilage;$i++){
	if($i==$myrow['privilage']){
		echo $myrow['privilage'];
	}else{
		$is = $myrow['id'];
		if($myrow['privilage']<=$_SESSION['p'] and  $is!=$_SESSION['ID'] and $i<=$_SESSION['p'])
		echo "<a href='userlist-2.php?cid=$is&n=$i'>$i</a>";
	}
};

}
echo "</td></tr>";
};

echo "</table>";
include "footer.php";
?>
