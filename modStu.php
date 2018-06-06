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
	$name=$_POST['name'];
	$sex=$_POST['sex'];
	$birthday=$_POST['birthday'];
	$hobby=$_POST['hobby'];
	$hobby=implode(',',$hobby);
	$desc=$_POST['desc'];
	$cid=$_POST['cid'];
	$oldname=$_FILES['file']['name'];
	$newname=time().strrchr($oldname,'.');
	$path='upload/'.$newname;
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		$sql="select newname from stu where id=$hid";
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
				$sql="update stu set name='$name',newname='$newname' where id=$hid";
			}
		}
	}
	else  
	{
		$sql="update stu set name='$name',sex='$sex',birthday='$birthday',hobby='$hobby',`desc`='$desc',cid='$cid' where id=$hid";
	}
	$query=mysqli_query($conn,$sql);
	if($query)
		echo '修改成功<script>setTimeout(\'location.href="stu.php"\',1000)</script>';
	else
		echo '修改失败<script>setTimeout(\'location.href="stu.php"\',1000)</script>';
}
else
{//进入页面，代码开始
	$id=$_GET['id'];
	$sql="select stu.id,stu.name,newname,sex,birthday,hobby,`desc`,class.name as cname,cid from stu join class on cid=class.id where stu.id=$id";
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_assoc($query);
	$hobby0=explode(',',$rs['hobby']);
?>
<form method="post" enctype="multipart/form-data">
<table border="1" cellspacing="1" cellpadding="1" width="100%" align="center">
	<tr>
		<td width="6%" height="19" bgcolor="#353c44" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="18" /></div></td>
		<td width="94%" valign="bottom" bgcolor="#353c44"><span class="STYLE1">学生信息修改</span></td>
	
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">姓名</div></td>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="text" name="name" value="<?php echo $rs['name']?>" required></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">原头像</div></td>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19">&nbsp;<img src="upload/<?php echo $rs['newname']?>" width="50"></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">性别</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19">&nbsp;<input type="radio" name="sex" value="男"
		<?php 
		if($rs['sex']=='男')
		echo 'checked="checked"'
		?>
		>男
		<input type="radio" name="sex" value="女"
		<?php if ($rs['sex']=='女')
		echo 'checked="checked"'
		?>>女</td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">生日</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="text" name="birthday" value="<?php echo $rs['birthday']?>" required></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">爱好</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;
		<?php
		$hobby=array('足球','滑板','篮球');
		foreach($hobby as $value)
		{
		?>
		<input type="checkbox" name="hobby[]" value="<?php echo $value?>"
		<?php 
		foreach($hobby0 as $value0)
		{
		 if($value==$value0)
			echo 'checked="checked"';
		}
		?>
		><?php echo $value?>
		<?php
		}
		?>
		</div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">简介</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<textarea name="desc"><?php echo $rs['desc']?></textarea></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">班级</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<select name="cid">
			<?php
			$sqlCla="select * from class";
			$queryCla=mysqli_query($conn,$sqlCla);
			while($rsCla=mysqli_fetch_assoc($queryCla))
			{
			?>
			<option value="<?php echo $rsCla['id']?>"
			<?php
			if($rs['cid']==$rsCla['id'])
				echo 'selected="selected"';
			?>>
			<?php echo $rsCla['name']?>
			</option>
			<?php } ?>
			</select></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">头像</div></td>
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
