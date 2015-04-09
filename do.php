<?php
require('redis.php');

$uid = $_POST['uid'];
$uName = $_POST['username'];
$age = $_POST['age'];

$res = $redis->hmset("user:".$uid,array("username"=>$uName,"age"=>$age)); 


exit($res);

if($res){
	header("location:list.php");
}else{
	header("location:modify.php?id=".$uid);
}
