<?php
session_start();
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>管理中心登陆 v1.0</title>
<meta http-equiv=content-type content="text/html; charset=utf-8">
<link href="css/admin.css" type="text/css" rel="stylesheet">
</head>
<body onload=document.form1.name.focus();>
<?php
	require 'config.php';
	if(isset($_GET['sub']))
	{
		$user=$_GET['user'];
		$pwd=$_GET['pwd'];
		$sql="select *from user where user='$user' and pwd='$pwd'";
		$query=mysqli_query($conn,$sql);
		$rs=mysqli_fetch_assoc($query);
		$id=$rs['id'];
		$num=mysqli_num_rows($query);
		if($num)
		{
			$_SESSION['user']=$user;
			$_SESSION['pwd']=$pwd;
			$_SESSION['id']=$id;
			@$time=date('Y-m-d h:i:s');
			$_SESSION['time']=$time;
			$sql="update user set times=times+1 where id=$id";
			$query=mysqli_query($conn,$sql);
			echo '<font face="楷体" size="6">登录成功,请稍等...</font><script>setTimeout(\'location.href="index.php"\',1)</script>';
		}
		else
			echo '<font face="楷体" size="6">不知道为何，登录失败，请检查后重新登录</font><script>setTimeout(\'location.href="login.php"\',2900)</script>';
	}
	else
	{
	?>	
	<form>
<table height="100%" cellspacing=0 cellpadding=0 width="100%" bgcolor=#002779 
border=0>
  <tr>
    <td align=middle>
      <table cellspacing=0 cellpadding=0 width=468 border=0>
        <tr>
          <td><img height=23 src="images/login_1.jpg" 
          width=468></td></tr>
        <tr>
          <td><img height=147 src="images/login_2.jpg" 
            width=468></td></tr></table>
      <table cellspacing=0 cellpadding=0 width=468 bgcolor=#ffffff border=0>
        <tr>
          <td width=16><img height=200 src="images/login_3.jpg" 
            width=16></td>
          <td align=middle>
            <table cellspacing=0 cellpadding=0 width=230 border=0>
              <form name=form1 action="index.php" method=post>
              <tr height=5>
                <td width=5></td>
                <td width=56></td>
                <td></td></tr>
              <tr height=36>
                <td></td>
                <td>用户名</td>
                <td><input 
                  style="border-right: #000000 1px solid; border-top: #000000 1px solid; border-left: #000000 1px solid; border-bottom: #000000 1px solid" 
                  maxlength=30 size=24  name=user></td></tr>
              <tr height=36>
                <td>&nbsp; </td>
                <td>口　令</td>
                <td><input 
                  style="border-right: #000000 1px solid; border-top: #000000 1px solid; border-left: #000000 1px solid; border-bottom: #000000 1px solid" 
                  type=password maxlength=30 required size=24 
                name="pwd"></td></tr>
              <tr height=5>
                <td colspan=3></td></tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" name="sub" value="登录"></td></tr></form></table></td>
          <td width=16><img height=200 src="images/login_4.jpg" 
            width=16></td></tr>
			
			</table>
      <table cellspacing=0 cellpadding=0 width=468 border=0>
        <tr>
          <td><img height=16 src="images/login_5.jpg" 
          width=468></td></tr></table>
      <table cellspacing=0 cellpadding=0 width=468 border=0>
        <tr>
          </tr></table></td></tr></table>
		  <?php }?></body></html>
