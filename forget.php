<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>找回密码</title>
</head>
<body bgcolor="#eaeaec" background="bg.png" style=" background-repeat:no-repeat ;
background-size:40%; 
background-attachment: fixed;">
<?php
require 'config.php';
if(isset($_GET['sub']))
{
	$user=$_GET['user'];
	$pwd=$_GET['pwd'];
	$mail=$_GET['mail'];
	$sql="update user set pwd='$pwd' where `user`='$user' and mail='$mail'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		echo '密码修改成功 <script>setTimeout(\'location.href="login.php"\',1)</script>';
	}
	else
		echo '密码修改失败,检查后再重试一遍吧 <script>setTimeout(\'location.href="forget.php"\',1)</script>';
}
else
{
?>	
<form>
<table align="center" valign="middle"  bgcolor="white" width="400" style="border-radius:20px;">
	<center>
		<h2><font face="楷体" color="#ff3300"></font></h2>
	<center>
	<tr>
		<th colspan="2">密码修改</th>
	</tr>
	<tr>
		<td>用户名:</td>
		<td><input type="text" size="20" name="user" placeholder="请输入用户名" style="border-radius:5px; height:25px;"required></td>
	</tr>
	<tr>
		<td>邮箱</td>
		<td><input type="text" name="mail" placeholder="请输入验证邮箱" style="border-radius:5px; height:25px;" required></td>
	</tr>
	<tr>
		<td>密&nbsp;码:</td>
		<td><input type="text" name="pwd" placeholder="请输入密码" style="border-radius:5px; height:25px;" required></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="submit" name="sub" value="修改">
		</td>
	</tr>
<?php }?>
<table>
</form>
</body>
</html>
