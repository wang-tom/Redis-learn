Redis DB for php APi

1.redis.php 连接到redis for php 数据库
$redis = new Redis();  //实例化
$redis->connect("localhost",6379);  //连接服务器

2.form.php
构造form表单，用户名 密码 年龄 提交 重置按钮 --- 提交到reg.php 文件

3.reg.php
接收从form.php提交的参数:
$uName = $_POST['username'];
$uPwd = $_POST['password'];
$age = $_POST['age'];
$uid = $redis->incr("userid");
$redis->hmset("user:".$uid,array("uid"=>$uid,"username"=>$uName,"password"=>$uPwd,"age"=>$age));
header('location:list.php');

4.list.php
获取redis数据库存储的key/value
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

5.modify.php
修改指定的key/value值
require('redis.php');
$uid = $_GET['uid'];
$data = $redis->hgetall("user:".$uid);
<form action="do.php" method="post">
	<input type="hidden" name="uid" value="<?php echo $data['uid']?>" />
        用户：<input type="text" name="username" value="<?php echo $data['username']?>"/><br>
        年龄：<input type="text" name="age" value="<?php echo $data['age']?>"/><br>
        <input type="submit" value="提交" />
        <input type="reset" value="重置" />
</form>

6.do.php
处理修改key/value逻辑操作
require('redis.php');
$uid = $_POST['uid'];
$uName = $_POST['username'];
$age = $_POST['age'];
$res = $redis->hmset("user:".$uid,array("username"=>$uName,"age"=>$age)); 
if($res){
	header("location:list.php");
}else{
	header("location:modify.php?id=".$uid);
}

7.删除指定的key/value 值
require('redis.php');
$uid = $_GET['uid'];
$redis->del("user:".$uid);
header('location:list.php');




