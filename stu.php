<?php
session_start();
if(empty($_SESSION['user']))
{
	header('location:login.php');
}
?>
<?php
$wherelist=array();
$urlist=array();
if(!empty($_GET['id']))
{
$wherelist[]=" id like '%".$_GET['id']."%'";
$urllist[]="id=".$_GET['id'];
  
}
if(!empty($_GET['username']))
{
$wherelist[]=" username like '%".$_GET['username']."%'";
$urllist[]="username=".$_GET['username'];
}if(!empty($_GET['age']))
{
$wherelist[]=" age like '%".$_GET['age']."%'";
$urllist[]="age=".$_GET['age'];
}
$where="";
if(count($wherelist)>0)
{
$where=" where ".implode(' and ',$wherelist);
$url='&'.implode('&',$urllist);
}?>
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
require_once 'config.php';
$sql="select stu.id,newname,stu.name,sex,birthday,hobby,`desc`,cname from stu join class on cid=class.id order by stu.id desc";
$query=mysqli_query($conn,$sql);
//分页
$num=mysqli_num_rows($query);
$pageSize=10;
$pageMax=ceil($num/$pageSize);
$page=isset($_GET['page'])?$_GET['page']:1;
$page=$page>$pageMax?$pageMax:$page;
$page=$page<1?1:$page;
$sql.=" limit ".($page-1)*$pageSize.",".$pageSize;
$query=mysqli_query($conn,$sql);
?>
	<body>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
					<td width="94%" valign="bottom"><span class="STYLE1"> 学生基本信息列表</span></td>
					
					
				  </tr>
				</table></td>
				<td ><div align="right"><span class="STYLE1">
				   <a href="addStu.php" style="COLOR: #fff"><img src="images/add.gif" width="10" height="10" />添加</a>   &nbsp; <span class="STYLE1"> &nbsp;</span></div></td>
			  </tr>
			</table></td>
		  </tr>
		</table></td>
	  </tr>
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" onmouseover="changeto()"  onmouseout="changeback()">
		  <tr>
			<td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
			  <input type="checkbox" name="checkbox" id="checkbox" />
			</div></td>
			<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">编号</span></div></td>
			<td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">姓名</span></div></td>
			<td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">头像</span></div></td>
			<td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">性别</span></div></td>
			<td width="13%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">生日</span></div></td>
			<td width="11%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">爱好</span></div></td>
			<td width="15%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">简介</span></div></td>
			 <td width="7%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">班级</span></div></td>
			<td width="4%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">操作</span></div></td>
		  </tr>
		  <?php
		  $i=1;
		  while($rs=mysqli_fetch_assoc($query))
		  {
		  ?>
		  <tr>
			<td height="10" bgcolor="#FFFFFF"><div align="center">
			  <input type="checkbox" name="checkbox10" id="checkbox10" />
			</div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $i++?></div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rs['name']?></div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><img src="upload/<?php echo $rs['newname']?>" width="50"></div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rs['sex']?></div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rs['birthday']?></div></td>
			<td height="10" bgcolor="#FFFFFF"><div align="center"><span class="STYLE21"><?php echo $rs['hobby']?></span></div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center">
				<?php
				if(mb_strlen($rs['desc'])>5)
				  echo mb_substr($rs['desc'],0,5).'...';
				else
				  echo $rs['desc'];
				?>
			</div>
			</td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo  $rs['cname']?></div></td>
			<td height="10" bgcolor="#FFFFFF" class="STYLE19" ><div align="center" width="100"><a href="delStu.php?id=<?php echo $rs['id']?>" onclick="return confirm('are you sure?')" style="COLOR: blue">删除</a>|<a href="modStu.php?id=<?php echo $rs['id']?>" style="COLOR: blue">修改</a></div></td>
		  </tr>
		  <?php }?>
		</table></td>
	  </tr>
	  <form>
	  <tr>
		<td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="33%"><div align="left"><span class="STYLE22">&nbsp;&nbsp;&nbsp;&nbsp;共有<strong><?php echo $num?></strong> 条记录，当前第<strong> <?php echo $page?></strong> 页，共 <strong><?php echo $pageMax?></strong> 页</span></div></td>
			<td width="67%"><table width="312" border="0" align="right" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="49"><div align="center"><a href="?page=1"><img src="images/main_54.gif" width="40" height="15" /></a></div>
				</td>
				<td width="49"><div align="center"><a href="?page=<?php if ($page>1) echo $page-1;else echo 1;?>"><img src="images/main_56.gif" width="45" height="15" /></a></div>
				</td>
				<td width="49"><div align="center"><a href="?page=<?php if ($page<$pageMax) echo  $page+1;else echo $pageMax;?>"><img src="images/main_58.gif" width="45" height="15" /></a></div>
				</td>
				<td width="49"><div align="center"><a href="?page=<?php echo $pageMax?>"><img src="images/main_60.gif" width="40" height="15" /></a></div>
				</td>
				<td width="37" class="STYLE22"><div align="center">转到</div></td>
				<td width="22"><div align="center">
				  <input type="text" name="page" id="textfield"  style="width:20px; height:12px; font-size:12px; border:solid 1px #7aaebd;"/>
				</div></td>
				<td width="22" class="STYLE22"><div align="center">页</div></td>
				<td width="35"><input type="submit" name="sub" value="跳转"></td>
			  </tr>
			</table>
		</form>
		</td>
      </tr>
    </table>
	</td>
  </tr>
</table>

</body>
</html>
