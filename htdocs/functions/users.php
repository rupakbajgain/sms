<?php
class users{
public function addNew($name,$password){
global $db;
$name = mysql_escape_string($name);
$password = mysql_escape_string($password);
mysql_query("INSERT INTO users(name,password) VALUES ('$name',PASSWORD('$password'));",$db);
}

public function getIdFromName($name){
global $db;
$name=mysql_escape_string($name);
$result=mysql_query("SELECT id FROM users WHERE name='$name';",$db);
if($myrow = mysql_fetch_array($result))return $myrow[0]; else return 0;
}

public function getNameFromId($name){
global $db;
$name=mysql_escape_string($name);
$result=mysql_query("SELECT name FROM users WHERE id='$name';",$db);
if($myrow = mysql_fetch_array($result))return $myrow[0]; else return 0;
}

public function getPrivilageFromId($id){
global $db;
$result=mysql_query("SELECT privilage FROM users WHERE id='$id';",$db);
if($myrow = mysql_fetch_array($result))return $myrow[0]; else return 0;
}

public function isValid($name,$password){
global $db;
$name = mysql_escape_string($name);
$password = mysql_escape_string($password);
$result=mysql_query("SELECT PASSWORD('$password');",$db);
$myrow = mysql_fetch_array($result);
$password=$myrow[0];
$result=mysql_query("SELECT password FROM users WHERE name='$name';",$db);
if($myrow = mysql_fetch_array($result))$ps = $myrow[0]; else return false;
if($ps==$password)return true; else return false;
}

public function changePassword($name,$oldpassword,$newpassword){
global $db;
$name = mysql_escape_string($name);
$newpassword = mysql_escape_string($newpassword);
if($this->isValid($name,$oldpassword)){
mysql_query("UPDATE users SET password=PASSWORD('$newpassword') WHERE name='$name';",$db);
return true;
}
return false;
}


}

?>
