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
require_once 'config.php';
$sql="select * from user order by id desc";
$query=mysqli_query($conn,$sql);
$rs=mysqli_fetch_assoc($query);
//分页
//查询条数
$num=mysqli_num_rows($query);
//设每页条数为7
$pageSize=10;
//最大页
$pageMax=ceil($num/$pageSize);
//当前页
$page=isset($_GET['page'])?$_GET['page']:1;
//对当前页进行判断，如果点击了就得到接收值，否则就是首页
$page=$page>$pageMax?$pageMax:$page;
//对应跳转最大页
$page=$page<1?1:$page;
//对应跳转最小
//sql语句
$sql.=" limit ".($page-1)*$pageSize.",".$pageSize;
//sql语句内容:limit (n-1)*n,10 
$query=mysqli_query($conn,$sql);
//再执行一遍
if($rs['uid']==0)//判断是否为超级管理员
{
?>
<body>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" onmouseover="changeto()"  onmouseout="changeback()">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1">用户信息列表</span></td>
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
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" >
      <tr>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">编号</span></div></td>
        <td width="10%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">头像</span></div></td>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">用户名</span></div></td>
        <td width="10%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">注册时间</span></div></td>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">登录次数</span></div></td>		
        <td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">操作</span></div></td>
      </tr>
	  <?php
	  $i=1;
	  while($rs=mysqli_fetch_assoc($query))
	  {
	  ?>
      <tr>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $i++?></div></td>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><img src="upload/<?php echo $rs['newname']?>" width="50"></div></td>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $rs['user']?></div></td>
		<td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $rs['time']?></div></td>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $rs['times'].'次'?></div></td>

		<?php if($rs['uid']==0||$rs['uid']==1) {?>
		<td height="30" bgcolor="#FFFFFF" class="STYLE11" ><div align="center" width="100"><a href="delUser.php?id=<?php echo $rs['id']?>" onclick="return confirm('are you sure?')" style="COLOR: blue">删除</a>|<a href="modUser.php?id=<?php echo $rs['id']?>" style="COLOR: blue">修改</a></div></td>
		<?php }?>

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
		</form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
<?php 
}
else
//不是超级管理员
{
?>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" onmouseover="changeto()"  onmouseout="changeback()">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1">用户信息列表</span></td>
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
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" >
      <tr>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">编号</span></div></td>
        <td width="10%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">头像</span></div></td>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">用户名</span></div></td>
        <td width="10%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">注册时间</span></div></td>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE11">登录次数</span></div></td>		
       
      </tr>
	  <?php
	  $i=1;
	  while($rs=mysqli_fetch_assoc($query))
	  {
	  ?>
      <tr>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $i++?></div></td>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><img src="upload/<?php echo $rs['newname']?>" width="50"></div></td>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $rs['user']?></div></td>
		<td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $rs['time']?></div></td>
        <td height="30" bgcolor="#FFFFFF" class="STYLE11"><div align="center"><?php echo $rs['times'].'次'?></div></td>
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
		</form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
<?php
}
?>
</html>
