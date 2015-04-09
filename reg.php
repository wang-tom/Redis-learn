<?php

require('redis.php');
$uName = $_POST['username'];
$uPwd = $_POST['password'];
$age = $_POST['age'];
$uid = $redis->incr("userid");

$redis->hmset("user:".$uid,array("uid"=>$uid,"username"=>$uName,"password"=>$uPwd,"age"=>$age));

header('location:list.php');
