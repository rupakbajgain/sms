<?php
include "head.php";
include "header.php";
minPrivilage(3);
include "functions/connection.php";
?>
<form method="post">
<textarea name = "sqlstmt"></textarea><br>
<input type = "Submit" value = "Run">
</form>
<?php
if(isset($_POST['sqlstmt'])){
$t = explode("\n",$_POST['sqlstmt']);
for($i=0;$i<sizeof($t);$i++){
echo "<pre>".$t[$i]."\n";
$result = mysql_query($t[$i],$db);
while($myrow = mysql_fetch_array($result)){
print_r($myrow);
echo "\n";
}
echo "</pre>";
}
$_GET['p']="Sql statement executed.";
}

include "footer.php";
?>
