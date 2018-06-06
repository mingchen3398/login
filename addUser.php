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
if(isset($_POST['sub']))
{
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$repwd=$_POST['repwd'];
	if($pwd!=$repwd)
	{
		echo '两次密码不一致，请重新输入';
	}
	else
	{
		$mail=$_POST['mail'];
		$oldname=$_FILES['file']['name'];
		$tmp=strrchr($oldname,'.');
		$newname=time().$tmp;
		$path='upload/'.$newname;
		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
			if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
			{	
			@$time=date('Y-m-d h:i:s');
			$times=0;
				$sql="insert into user(id,`user`,pwd,mail,times,time,newname)values(null,'$user','$pwd','$mail','$times','$time','$newname')";
				$query=mysqli_query($conn,$sql);
				if($query)
					echo '添加成功
				<script>setTimeout(\'location.href="user.php"\',1)</script>';
				else
					echo '添加失败
				<script>setTimeout(\'location.href="user.php"\',1)</script>';
			}
		}
		else
		{
			@$time=date('Y-m-d h:i:s');
			$times=0;
			$sql="insert into user(user,pwd,times,time,newname) values('$user','$pwd','$times','$time','666666.gif')";
			$query=mysqli_query($conn,$sql);
			if($query)
				echo '<font size=7>添加用户成功</font><script>setTimeout(\'location.href="user.php"\',1000)</script>';
			else
				echo '<font size=7>添加用户失败，请尝试重新添加</font><script>setTimeout(\'location.href="user.php"\',1000)</script>';
		}
	}
}
else
{
?>
<form method="post" enctype="multipart/form-data">
<table width="100%" onmouseover="changeto()"  onmouseout="changeback()">
		<td bgcolor="#353c44" colspan="2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
					<td width="94%" valign="bottom" style="COLOR: #fff"><span class="STYLE1">用户信息添加列表</span></td>
				</tr>
			</table>
		</td>
		<tr>
		<td width="23%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">用户名</span></td>
		<td width="77%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="text" name="user" required></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">头像</span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="file" name="file" ></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">密码</span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="password" name="pwd" required></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">确认密码</span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="password" name="repwd" required></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">邮箱</span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="email" name="mail" required></span></td>
	</tr>
	<tr>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"></span></td>
		<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="submit" name="sub" value="添加"></span></td>
	</tr>
</table>
</form>
<?php }?>
</body>
</html>
