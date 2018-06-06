
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>欢迎注册</title>
</head>
<body body bgcolor="#eaeaec" background="bg.png" style=" background-repeat:no-repeat ;
background-size:40%; 
background-attachment: fixed;">
<?php
require 'config.php';
if(isset($_GET['sub']))
{
	$user=$_GET['user'];
	$pwd=$_GET['pwd'];
	$mail=$_GET['mail'];
	$time=date('Y-m-d H:i:s');
	$sql="insert into user (id,user,pwd,times,mail,newname,time)values(null,'$user','$pwd',0,'$mail','666666.gif','$time') ";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		echo '注册成功<script>setTimeout(\'location.href="login.php"\',1)</script>';
	}
	else
		echo '注册失败，原因可能是账号已存在<script>setTimeout(\'location.href="login.php"\',1698)</script>';
}
else
{
?>	
<form autocomplete="on">
<table bgcolor="white" valign="center" width="400" style="border-radius:20px;" align="center">
	<center>
	<h2>
	<font face="楷体" color="#ff3300"></font>
	</h2>
	<center>
	<tr>
	<th colspan="3"><font face="楷体" size="4">新用户注册</font></th>
	</tr>
	<tr>
		<td>用户名:</td>
		<td>
			<div class="list">
				<input TYPE="text" NAME="user" placeholder="请输入用户名" style="border-radius:5px; height:25px;"required ><br/>
		<th colspan="2" rowspan="2">
		<input type="image" name="sub" value="注册" src="register.png">
		</th>
			</div>
		</td>
	</tr>
	<tr>
		<td>密&nbsp;码:</td>
		<td><div class="list">
				<INPUT TYPE="password" NAME="pwd" placeholder="请输入密码" required style="border-radius:5px; height:25px;">
			</div>
		</td>
	</tr>
	<tr>
		<td>验证邮箱</td>
		<td><div class="list">
				<INPUT TYPE="email" name="mail" placeholder="很重要，不要乱写" autocomplete="off" style="border-radius:5px; height:25px;">
			</div>
		</td>
		<th><a href="login.php" style="color:red">返回</a></th>
	</tr>
	<tr>
	<th colspan="2"><br/></th>
	</tr>
<table>
<?php }?>
</form>
</body>
</html>
