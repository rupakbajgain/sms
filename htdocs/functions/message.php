<?php
include "functions/dom.php";

function user_login2($name,$pass){
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'www.meet.net.np');
$cookiesFile = "cookies_$name.txt";
unlink($cookiesFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiesFile); 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiesFile); 
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
$ret = curl_exec($ch);

$html = str_get_html($ret);
$d = array();
$frm = $html->find('form')[0];

foreach($html->find('input') as $i){
if($i->name!="")
	$d[$i->name]=$i->value;}
$d['username']=$name;
$d['password']=$pass;
$html->clear();

curl_setopt($ch,CURLOPT_URL,'www.meet.net.np/meet/action/login');
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($d));
$ret = curl_exec($ch);
curl_close($ch);
}

function user_login($user){
	global $db;
	$result = mysql_query("SELECT passord FROM dtable_users WHERE uname='$user';",$db);
	$pass = mysql_fetch_array($result)[0];
	user_login2($user,$pass);
}

function msg_get_field($name){
	global $db;
	$result = mysql_query("SELECT V FROM dtable_uinfo WHERE F='$name';",$db);
	return mysql_fetch_array($result)[0];
}

function msg_set_field($name,$value){
	global $db;
	mysql_query("UPDATE dtable_uinfo SET V = '$value' WHERE F='$name';",$db);
}

function msg_getIdFromId($id){
	global $db;
	$result = mysql_query("SELECT uname FROM dtable_users LIMIT 1 OFFSET $id;",$db);
	return mysql_fetch_array($result)[0];
}

function requestMessages($num){
	$c=msg_get_field('tot_sent');
	$cnt=msg_get_field('count');
	$max=msg_get_field('total_num');
	date_default_timezone_set('Asia/Kathmandu');
	if(msg_get_field('ldate')!==date("d")){
		msg_set_field('ldate',date("d"));
		msg_set_field('tot_rem',($max+1)*10);
	}
	$rem=msg_get_field('tot_rem');
	if($num>$rem){
		return false;
	}else{
		msg_set_field('tot_rem',$rem-$num);
	}
	$ret=array();
	while($num){
		$rem = 10-$c;
		if($num>$rem){
			array_push($ret,array(msg_getIdFromId($cnt),$rem));
			$num-=$rem;
			$rem=0;
		}else{
			array_push($ret,array(msg_getIdFromId($cnt),$num));
			$rem-=$num;
			$num=0;
			$num=0;
		}
		if($rem==0){
			$c=0;
			$cnt++;
			if($cnt==$max){
				$cnt=0;
			}
		}else{
			$c=10-$rem;
		}
	}
	msg_set_field('tot_sent',$c);
	msg_set_field('count',$cnt);
	return $ret;
}

function sendMessage($user,$number,$message){
global $db;
mysql_query("INSERT INTO dtable_sms(T,M) VALUES ('$number','".mysql_escape_string($message)."');",$db);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'www.meet.net.np');
$cookiesFile = "cookies_$user.txt";
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiesFile); 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiesFile); 
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch,CURLOPT_URL,'www.meet.net.np/meet//mod/sms/actions/send.php');
$d=array();
$d['SmsLanguage']='English';
$d['recipient']=$number;
$d['message']=$message;
$d['sendbutton']='Send Now';
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($d));
while(curl_exec($ch)===false);
curl_close($ch);
}
?>
