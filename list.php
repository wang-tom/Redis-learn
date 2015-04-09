<?php

include('redis.php');

for($i=1;$i<=($redis->get("userid"));$i++){
	$data[] = $redis->hgetall("user:".$i);
}

$data = array_filter($data);
?>

<table border="1" width="50%">
	<tr><th>姓名</th><th>密码</th><th>年龄</th><th>操作</th></tr>
	
	<?php foreach ($data as $val){ ?>
	<tr>
		<th><?php echo $val['uid']?></th>
		<th><?php echo $val['username']?></th>
		<th><?php echo $val['age']?></th>
		<th><a href="modify.php?uid=<?php echo $val['uid']?>">编辑</a>
		&nbsp;&nbsp;&nbsp;<a href="del.php?uid=<?php echo $val['uid']?>">删除</a></th>
	</tr>
	<?php }?>
</table>

