<?php
include "head.php";
include "header.php";
minPrivilage(2);
include "functions/connection.php";
include "functions/message.php";
if(isset($_GET['nm'])){
user_login($_GET['nm']);
$_GET['p']='Cookie file created!';
}
echo "<h2>Login for cookie</h2>\n";
echo "<table class = 'main'>";
echo "<tr><th>Name</th><th>Action</th></tr>";
$result = mysql_query("SELECT uname FROM dtable_users;",$db);
while($row=mysql_fetch_array($result)){
	echo "<tr><td>";
	echo $row['uname'];
	echo "</td><td>";
	echo "<a href='cookielogin-2.php?nm=".$row['uname']."'>Login<a/>";
	echo "</td></tr>";
};

echo "</table>";
include "footer.php";
?>
