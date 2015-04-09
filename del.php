<?php

require('redis.php');
$uid = $_GET['uid'];

$redis->del("user:".$uid);

header('location:list.php');
