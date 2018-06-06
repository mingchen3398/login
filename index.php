<?php
session_start();
if(empty($_SESSION['user']))
{
	header('location:login.php');
}
?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>管理中心 V3.0</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Cache-Control content=no-cache>
<META http-equiv=Expires content=-1000>
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
</HEAD>
<frameset  framespacing=0 rows="60, *" frameborder=0>
	<frame name=header src="header.php" frameborder=0 noresize scrolling=no>
	<frameset cols="170, *">
		<frame  src="menu.php" >
		<frame name=main src="main.php" >
	</frameset>
</frameset>
</HTML>
