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
	$name=$_POST['name'];
	$sql="insert into class values(null,'$name')";
	$query=mysqli_query($conn,$sql);
	if($query)
		echo '添加成功
	<script>setTimeout(\'location.href="class.php"\',1)</script>';
	else
		echo'添加失败
	<script>setTimeout(\'location.href="class.php"\',1)</script>';
}
else
{
?>
<form method="post" enctype="multipart/from-data">
<table width="100%">
	<tr>
	<td bgcolor="#353c44" colspan="2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
				<td width="94%" valign="bottom" style="COLOR: #fff"><span class="STYLE1">用户信息添加列表</span></td>
			</tr>
		</table>
	</td>
	<tr>
	<td width="23%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10">班级名字</span></td>
	<td width="77%" height="20" bgcolor="d3eaef" class="STYLE6"><span class="STYLE10"><input type="text" name="name" required></span></td>
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
