<?php
session_start();
if(empty($_SESSION['user']))
{
	header('location:login.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Document</title>
</head>
<body>
<?php
require 'config.php';
if(isset($_GET['sub']))
{
	$hidpwd=$_GET['hidpwd'];
	$ypwd=$_GET['ypwd'];
	$hid=$_GET['hid'];
	$pwd=$_GET['pwd'];
	$repwd=$_GET['repwd'];
	if($ypwd!=$hidpwd)
	{
		echo '原密码错误 <script>setTimeout(\'location.href="user.php"\',1)</script>';
	}
	else
	{
	if($pwd!=$repwd)
	{
		echo '两次密码不一致，请重新输入 <script>setTimeout(\'location.href="user.php"\',1)</script>';
	}
	else
	{
		$sql="update user set pwd='$pwd' where id=$hid";
		$query=mysqli_query($conn,$sql);
		if($query)
			echo '修改成功
		<script>setTimeout(\'parent.location.href="quit.php"\',1)</script>';
		else
			echo'修改失败
		<script>setTimeout(\'location.href="user.php"\',1)</script>';
	}
	}
}
else
{
	$sql="select * from user where id=".$_SESSION['id'];
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_assoc($query);
?>
<form method="get">
<table width="100%">
	<tr>
	<td bgcolor="#353c44" colspan="2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
				<td width="94%" valign="bottom" style="COLOR: #fff"><span class="STYLE1">用户密码修改列表</span></td>
			</tr>
		</table>
	</td>
	<tr>
	<td width="23%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">用户名</span></td>
	<td width="77%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="text"  value="<?php echo $rs['user']?>" disabled></span></td>
	</tr>
	<tr>
	<td width="23%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">原密码</span></td>
	<td width="77%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="password" name="ypwd" required></span></td>
	</tr>
	<tr>
	<td width="23%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">新密码</span></td>
	<td width="77%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="password" name="pwd" required></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">确认密码</span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="password" name="repwd" required></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">
		<input type="hidden" name="hidpwd" value="<?php echo $rs['pwd']?>">
		<input type="hidden" name="hid" value="<?php echo $rs['id']?>"></span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="submit" name="sub" value="修改"></span></td>
	</tr>
</table>
</form>
<?php }?>
</body>
</html>
