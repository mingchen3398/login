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
if(isset($_GET['sub']))
{
	$hid=$_GET['hid'];
	$name=$_GET['name'];
	$sql="update class set name='$name' where id=$hid";
	$query=mysqli_query($conn,$sql);
	if($query)
		echo '修改成功<script>setTimeout(\'location.href="class.php"\',1000)</script>';
	else 
		echo '修改失败 <script>setTimeout(\'location.href="class.php"\',1000)</script>';
}
else
{
	$id=$_GET['id'];
	$sql="select * from class where id=$id";
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_assoc($query);
?>
<body>
<form>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="images/tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1"> 班级修改</span></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" >
      <tr>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><span class="STYLE11">原班级名字</span></td>
        <td width="10%" height="30" bgcolor="d3eaef" class="STYLE6"><span class="STYLE11">&nbsp;<input type="text" value="<?php echo $rs['cname']?>"></span></td>
      </tr>
	  <tr>
		<td width="4%" height="30" bgcolor="d3eaef" class="STYLE6"><span class="STYLE11">新班级名字</span></td>
        <td width="10%" height="30" bgcolor="d3eaef" class="STYLE6"><span class="STYLE11">&nbsp;<input type="text" name="name"></span></td>
      </tr>
	  <tr>
		<td width="4%" height="30" bgcolor="ffffff" class="STYLE6"><div align="center"><span class="STYLE11"><input type="hidden" name="hid" value="<?php echo $rs['id']?>"></span></div></td>
        <td width="10%" height="30" bgcolor="ffffff" class="STYLE6"><span class="STYLE11">&nbsp;<input type="submit" name="sub" value="修改"></span></td>
      </tr>
    </table></td>
  </tr>
  </td>
      </tr>
    </table>
	<form>
	<?php }?>
	</td>
  </tr>
</table>
</body>
</html>
