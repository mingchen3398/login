<?php
session_start();
if(empty($_SESSION['user']))
{
	header('location:login.php');
}
?>
<!doctype html>
<html><head>
<meta http-equiv=content-type content="text/html; charset=utf-8">
<link href="css/admin.css" type="text/css" rel="stylesheet">
</head>
<?php
require 'config.php';
$sql="select * from user where id=".$_SESSION['id'];
$query=mysqli_query($conn,$sql);
$rs=mysqli_fetch_assoc($query);
@$time=date('Y-m-d H:i:s');
?>
<body>
<table cellspacing=0 cellpadding=0 width="100%" align=center border=0>
  <tr height=28>
    <td background=images/title_bg1.jpg>当前位置: </td></tr>
  <tr>
    <td bgcolor=#b1ceef height=1></td></tr>
  <tr height=20>
    <td background=images/shadow_bg.jpg></td></tr></table>
<table cellspacing=0 cellpadding=0 width="90%" align=center border=0>
  <tr height=100>
    <td align=middle width=100><img height=100 src="upload/<?php echo $rs['newname']?>" width=90></td>
    <td width=60>&nbsp;</td>
    <td>
      <table height=100 cellspacing=0 cellpadding=0 width="100%" border=0>
        
        <tr>
          <td>当前时间:<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script language=Javascript> 
  function time(){
    //获得显示时间的div
    t_div = document.getElementById('showtime');
   var now=new Date()
    //替换div内容 
   t_div.innerHTML = " "+now.getFullYear()
    +"年"+(now.getMonth()+1)+"月"+now.getDate()
    +"日"+now.getHours()+"时"+now.getMinutes()
    +"分"+now.getSeconds()+"秒";
    //等待一秒钟后调用time方法，由于settimeout在time方法内，所以可以无限调用
   setTimeout(time,1000);
  }
</script>
</head>

<body  onload="time()">
<div id="showtime"></div></td></tr>
        <tr>
          <td style="font-weight: bold; font-size: 16px"><?php echo $_SESSION['user']?></td></tr>
        <tr>
          <td>欢迎进入网站管理中心！</td></tr></table></td></tr>
  <tr>
    <td colspan=3 height=10></td></tr></table>
<table cellspacing=0 cellpadding=0 width="95%" align=center border=0>
  <tr height=20>
    <td></td></tr>
  <tr height=22>
    <td style="padding-left: 20px; font-weight: bold; color: #ffffff" 
    align=middle background=images/title_bg2.jpg>您的相关信息</td></tr>
  <tr bgcolor=#ecf4fc height=12>
    <td></td></tr>
  <tr height=20>
    <td></td></tr></table>
<table cellspacing=0 cellpadding=2 width="95%" align=center border=0>
  <tr>
    <td align=right width=100>登陆帐号：</td>
    <td style="color: #880000"><?php echo $_SESSION['user']?></td></tr>
  <tr>
    <td align=right>注册时间：</td>
    <td style="color: #880000"><?php echo $rs['time']?></td></tr>
  <tr>
    <td align=right>登陆次数：</td>
    <td style="color: #880000"><?php echo $rs['times']?></td></tr>
  <tr>
    <td align=right>上线时间：</td>
    <td style="color: #880000"><?php echo $time?></td></tr>
  <tr>
    <td align=right>    开发者    联系方式：</td>
    <td style="color: #880000">mingchen3398@gmail.com</td></tr>
  </table></body></html>