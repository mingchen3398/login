<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<SCRIPT language=javascript>
	function expand(el)
	{
		childObj = document.getElementById("child" + el);

		if (childObj.style.display == 'none')
		{
			childObj.style.display = 'block';
		}
		else
		{
			childObj.style.display = 'none';
		}
		return;
	}
</SCRIPT>
<style type="text/css">
<!--
a:link {
 text-decoration: none;
}
a:visited {
 text-decoration: none;
}
a:hover {
 text-decoration: none;
}
a:active {
 text-decoration: none;
}
-->
</style>
<!--<style>内为去掉超链接下划线代码-->
</HEAD>
<BODY>
<TABLE height="100%" cellSpacing=0 cellPadding=0 width=170 
background=images/menu_bg.jpg border=0>
  <TR>
    <TD vAlign=top align=middle>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        
        <TR>
          <TD height=10></TD></TR></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A 
            class=menuParent  style="COLOR: #353535" onclick=expand(1) 
            href="javascript:void(0);">显示管理</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id=child1 style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 
            src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild 
            href="stu.php" 
            target=main  style="COLOR: #353535">学生信息展示</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 
            src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild 
            href="addStu.php" 
            target=main  style="COLOR: #353535">学生信息添加</A></TD></TR>
      </TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A 
            class=menuParent onclick=expand(2) 
            href="javascript:void(0);"  style="COLOR: #353535">班级管理</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id=child2 style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 
            src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild 
            href="class.php" 
            target=main  style="COLOR: #353535">班级信息展示</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 
            src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild 
            href="addClass.php" 
            target=main  style="COLOR: #353535">班级信息添加</A></TD></TR>
       </TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A 
            class=menuParent onclick=expand(0) 
            href="javascript:void(0);"  style="COLOR: #353535">用户管理</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id=child0 style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
	  <tr height=20>
          <td align=middle width=30><img height=9 
            src="images/menu_icon.gif" width=9></td>
          <td><a class=menuchild 
            href="user.php" 
            target=main  style="COLOR: #353535">用户展示</a></td></tr>
        <tr height=20>
          <td align=middle width=30><img height=9 
            src="images/menu_icon.gif" width=9></td>
          <td><a class=menuchild 
            href="addUser.php" 
            target=main  style="COLOR: #353535">用户添加</a></td></tr>
        <tr height=20>
          <td align=middle width=30><img height=9 
            src="images/menu_icon.gif" width=9></td>
          <td><a class=menuchild 
            href="modPwd.php" 
            target=main  style="color: #353535">修改口令</a></td></tr>
        <tr height=20>
          <td align=middle width=30><img height=9 
            src="images/menu_icon.gif" width=9></td>
          <td><a class=menuchild 
            onclick="if (confirm('确定要退出吗？')) return true; else return false;" 
            href="quit.php" 
            target=_top  style="color: #353535">退出系统</a></td></tr>
      </table></body></html>
