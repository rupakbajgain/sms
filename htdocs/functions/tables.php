<?php
class tables{
public function addNew($name){
global $db;
$name = mysql_escape_string($name);
$id = mysql_escape_string($id);
mysql_query("INSERT INTO tables(name) VALUES ('$name');",$db);
mysql_query("CREATE TABLE dtable_$name(id INT AUTO_INCREMENT PRIMARY KEY);",$db);
}

public function getIdFromName($name){
global $db;
$name=mysql_escape_string($name);
$result=mysql_query("SELECT id FROM tables WHERE name='$name';",$db);
if($myrow = mysql_fetch_array($result))return $myrow[0]; else return 0;
}

public function getNameFromId($name){
global $db;
$name=mysql_escape_string($name);
$result=mysql_query("SELECT name FROM tables WHERE id='$name';",$db);
if($myrow = mysql_fetch_array($result))return $myrow[0]; else return 0;
}

}

?>
