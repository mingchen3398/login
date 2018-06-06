<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>修改密码</title>
</head>
<body bgcolor="#eaeaec" background="bg.png" style=" background-repeat:no-repeat ;
background-size:40%; 
background-attachment: fixed;">
<?php
require 'config.php';
if(isset($_GET['sub']))
{
	
	$hidden=$_GET['hidden'];
	$user=$_GET['user'];
	$pwd=sha1($_GET['pwd']);
	$sql="update user set pwd='$pwd' where `user`='$user' and id='$hidden'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		echo '<center><font face="楷体" size="7">密码修改成功 <script>setTimeout(\'location.href="index.php"\',1)</script>';
	}
	else
		echo '密码修改失败';
}
else
	{
	$user=$_GET['user'];
	$sql1="select * from user where `user`='$user'";
	$query1=mysqli_query($conn,$sql1);
	$rs=mysqli_fetch_assoc($query1);

?>
<form>
<table bgcolor="white" align="center" width="400" style="border-radius:20px;">
	<center><h2><font face="楷体" color="#ff3300"></font></h2><center>
	<tr>
		<td>用户名:</td>
		<td><input TYPE="text" NAME="user" value="<?php echo $rs['user']?>" placeholder="请输入用户名" style="border-radius:5px; height:25px;"required ></td>
	</tr>
	<tr>
		<td>原密码</td>
		<td><input type="text" name="pwd" value="<?php echo $rs['pwd']?>"  style="border-radius:5px; height:25px;" required></td>
	</tr>
	<tr>
		<td>新密码:</td>
		<td><input type="text" name="pwd" placeholder="请输入密码" style="border-radius:5px; height:25px;" required></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="hidden" name="hidden" value="<?php echo $rs['id']?>">
		<input type="submit" name="sub" value="修改">
		</td>
	</tr>
<table>
</form>
<?php }?>
</body>
</html>
