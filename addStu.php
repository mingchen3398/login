<?php
session_start();
if(empty($_SESSION['user']))
{
	header('location:login.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
<!--
body {
	margin-left: 3px;
	margin-top: 0px;
	margin-right: 3px;
	margin-bottom: 0px;
}
.STYLE1 {
	color: #e1e2e3;
	font-size: 12px;
}
.STYLE6 {color: #000000; font-size: 12; }
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {
	color: #344b50;
	font-size: 12px;
}
.STYLE21 {
	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {
	font-size: 12px;
	color: #295568;
}
-->
</style>
<script>
var  highlightcolor='#d5f4fe';
//此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(
var  clickcolor='#51b2f6';
function  changeto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=highlightcolor&&source.id!="nc"&&cs[1].style.backgroundColor!=clickcolor)
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=highlightcolor;
}
}

function  changeback(){
if  (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="nc")
return
if  (event.toElement!=source&&cs[1].style.backgroundColor!=clickcolor)
//source.style.backgroundColor=originalcolor
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}

function  clickto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=clickcolor&&source.id!="nc")
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=clickcolor;
}
else
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}
</script>
</head>
<?php
require 'config.php';
if(isset($_POST['sub']))
{
	$name=$_POST['name'];
	$sex=$_POST['sex'];
	$birthday=$_POST['birthday'];
	$hobby=$_POST['hobby'];
	$hobby=implode(',',$hobby);
	$desc=$_POST['desc'];
	$cid=$_POST['cid'];
	//图片上传
	$oldname=$_FILES['file']['name'];
	$tmp=strrchr($oldname,'.');
	$newname=time().$tmp;
	$path="upload/".$newname;
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
		$sql="insert into stu values(null,'$name','$sex','$newname','$birthday','$hobby','$desc',$cid)";
		$query=mysqli_query($conn,$sql);
		if($query>0)
			echo '添加成功
			<script>setTimeout(\'location.href="stu.php"\',1)</script>';
		else
			echo '添加失败
			<script>setTimeout(\'location.href="stu.php"\',1)</script>';
	}
}
else
{
?>
<body>
<form method="post" enctype="multipart/form-data">
<table border="1" cellspacing="1" cellpadding="1" width="60%" align="left">
	<tr>
		
		<td width="6%" height="19" bgcolor="#353c44" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="18" /></div></td>
		<td width="94%" valign="bottom" bgcolor="#353c44"><span class="STYLE1">学生信息添加</span></td>
	
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">姓名</div></td>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="text" name="name" required placeholder="请输入姓名" style="border-radius:3px; height:25px;"></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">性别</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="radio" name="sex" value="男" checked="checked">男
		<input type="radio" name="sex" value="女">女</div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">生日</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="date" name="birthday" required></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">爱好</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<?php
		$hobby=array('足球','滑板','篮球');
		foreach($hobby as $value)
		{
		?>
		<input type="checkbox" name="hobby[]" value="<?php echo $value?>"><?php echo $value?>
		<?php }?>
		</div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">简介</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<textarea name="desc" placeholder="请输入简介" style="border-radius:5px; height:27px;"></textarea></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">班级</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<select name="cid">
			<?php
			$sql="select * from class";
			$query=mysqli_query($conn,$sql);
			while($rs=mysqli_fetch_assoc($query))
			{
			?>
				<option value="<?php echo $rs['id']?>">
					<?php echo $rs['cname']?>
				</option>
			<?php }?>
			</select></div></td>
     </tr>
	 <tr>
        <td height="27" bgcolor="#FFFFFF" class="STYLE19"><div align="center">头像</div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="file" name="file" required></div></td>
     </tr>
	 <tr>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div ></div></td>
        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div >&nbsp;<input type="submit" name="sub" value="添加">
		<input type="reset" name="reset" value="重置"></div></td>
     </tr>
</table>
</form>
<?php }?>
</body>
</html>
