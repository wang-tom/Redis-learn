<?php

require('redis.php');
$uid = $_GET['uid'];

$data = $redis->hgetall("user:".$uid);

?>
<form action="do.php" method="post">
	<input type="hidden" name="uid" value="<?php echo $data['uid']?>" />
        用户：<input type="text" name="username" value="<?php echo $data['username']?>"/><br>
        年龄：<input type="text" name="age" value="<?php echo $data['age']?>"/><br>
        <input type="submit" value="提交" />
        <input type="reset" value="重置" />
</form>


