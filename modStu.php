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
<title>修改页</title>
</head>
<body>
<?php
require'config.php';
if(isset($_POST['sub']))
{
	$hid=$_POST['hid'];
	$oldname=$_FILES['file']['name'];
	$newname=time().strrchr($oldname,'.');
	$path='upload/'.$newname;
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		$user=$_POST['user'];
		$mail=$_POST['mail'];
		$times=$_POST['times'];
		$time=$_POST['time'];
		$sql="select newname from user where id=$hid";
		$query=mysqli_query($conn,$sql);
		$rs=mysqli_fetch_assoc($query);
		$path='upload/'.$rs['newname'];
		if(file_exists($path))
		{
		@unlink($path);
		clearstatcache();
		}
		$oldname=$_FILES['file']['name'];	
		$tmp=strrchr($oldname,'.');
		$newname=time().$tmp;
		$path='upload/'.$newname;
		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
			if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
			{
				$sql="update user set user='$user', newname='$newname' where id=$hid";
			}
		}
	}
	else  
	{
		$user=$_POST['user'];
		$mail=$_POST['mail'];
		$times=$_POST['times'];
		$time=$_POST['time'];
		$sql="update user set user='$user',mail='$mail',times='$times',time='$time'where id=$hid";
	}
	$query=mysqli_query($conn,$sql);
	if($query)
		echo '修改成功<script>setTimeout(\'location.href="user.php"\',1000)</script>';
	else
		echo '修改失败<script>setTimeout(\'location.href="user.php"\',1000)</script>';
}
else
{//进入页面，代码开始
	$id=$_GET['id'];
	$sql="select * from user where id=$id";
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_assoc($query);
?>
<form method="post" enctype="multipart/form-data">
<table border="1" cellspacing="1" cellpadding="1" width="60%"  onmouseover="changeto()"  onmouseout="changeback()">
	<tr>
		<td width="6%" height="19" bgcolor="#353c44" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="18" /></div></td>
		<td width="94%" valign="bottom" bgcolor="#353c44"><span class="STYLE1">用户信息修改</span></td>
	
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">用户名</div></td>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="text" name="user" value="<?php echo $rs['user']?>" disabled></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">原头像</div></td>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19">&nbsp;<img src="upload/<?php echo $rs['newname']?>" width="50"></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">邮箱</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">&nbsp;<input type=text name="mail" value="<?php echo $rs['mail']?>"></td>
     </tr>


	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">密码</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">&nbsp;<input type=text name="mail" value="<?php echo $rs['pwd']?>"></td>
     </tr>


	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">登录次数</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type=text name="times"value="<?php echo $rs['times']?>">
		</div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">注册时间</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type=text name="time"value="<?php echo $rs['time']?>"></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">新头像</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="file" name="file" ></div></td>
     </tr>
	 <tr>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div ><input type="hidden" name="hid" value="<?php echo $id?>"></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="submit" name="sub" value="修改"></div></td>
     </tr>
</table>
</form>
<?php }?>
</body>
</html>
