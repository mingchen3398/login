<?php
session_start();
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>管理中心登陆 v3.0</title>
<meta http-equiv=content-type content="text/html; charset=utf-8">
<link href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
    .code
    {
            background:url(code_bg.jpg);
            font-family:Arial;
            font-style:italic;
             color:blue;
             font-size:15px;
             border:0;
             padding:2px 3px;
             letter-spacing:3px;
             font-weight:bolder;             
             float:left;            
             cursor:pointer;
             width:55;
             height:30px;
             line-height:30px;
             text-align:center;
             vertical-align:middle;

    }
    a
    {
        text-decoration:none;
        font-size:12px;
        color:#288bc4;
        }
    a:hover
    {
       text-decoration:underline;
        }
    </style>
    <script language="javascript" type="text/javascript">

        var code;
        function createCode() {
            code = "";
            var codeLength = 4; //验证码的长度
            var checkCode = document.getElementById("checkCode");
            var codeChars = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','汪','万','有','哈','征','赋','赤','天','文','空','拉','腾','辉','平','聪','凯','杰','海','祥','长','龙','东','岳','调','筑','栋'); //所有候选组成验证码的字符，当然也可以用中文的
            for (var i = 0; i < codeLength; i++) 
            {
                var charNum = Math.floor(Math.random() * 52);
                code += codeChars[charNum];
            }
            if (checkCode) 
            {
                checkCode.className = "code";
                checkCode.innerHTML = code;
            }
        }
        function validateCode() 
        {
            var inputCode = document.getElementById("inputCode").value;
            if (inputCode.length <= 0) 
            {
                alert("请输入验证码！");
				return false;
            }
            else if (inputCode.toUpperCase() != code.toUpperCase()) 
            {
                alert("验证码输入有误！");
                createCode();
				return false;
            }
            else 
            {
               //alert("验证码正确！");
				return true;
            }        
        }    
     </script>
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
              <form name=form1 action="index.php" method=post  id="form1" runat="server" onsubmit="validateCode()">
              <tr height=5>
                <td width=5></td>
                <td width=56></td>
                <td></td></tr>
              <tr height=36>
                <td></td>
                <td>用户名</td>
                <td><input 
                  style="border-right: #000000 1px solid; border-top: #000000 1px solid; border-left: #000000 1px solid; border-bottom: #000000 1px solid"  placeholder="请输入用户名" style="border-radius:5px; height:25px;"
                  maxlength=30 size=24  name=user required autofocus="autofocus" ></td></tr>
              <tr height=36>
                <td>&nbsp; </td>
                <td>口　令</td>
                <td><input 
                  style="border-right: #000000 1px solid; border-top: #000000 1px solid; border-left: #000000 1px solid; border-bottom: #000000 1px solid"   placeholder="请输入口令" style="border-radius:5px; height:25px;"
                  type=password maxlength=30 required size=24 
                name="pwd"></td></tr>
			<tr height=36>
			<script>
				window.onload=function()
				{
					createCode();//打开网页即显示验证码
				}
			</script>
                <td>&nbsp; </td>
                <td>验证码</td>
				<td>
				<table>
					<tr>
					<td><div class="code" id="checkCode" onclick="createCode()" ></td>
					<td><a  href="#" onclick="createCode()">看不清换一张</a></td>
					</tr>
				</table>
				</td>
                <td></td></tr>
				 <tr height=36>
                <td>&nbsp;</td>
                <td>请输入</td>
                <td><table><tr><td><input type="text" size="4" required id="inputCode" /></td><td><input id="Button1"  onclick="return validateCode();" type="submit" name="sub" value="确定" /></td>
				<td>&nbsp;</td><td><table><tr><td><a href="register.php" style="color:red">注册账号</a></td></tr>
				<tr><td><a href="forget.php" style="color:red">忘记密码？</a></td></tr></table></td>
				</tr>
				
				</table></td></tr>
              <tr height=5>
               </tr>
              <tr>
               
                <td></td></tr></form></table></td>
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



		<!--	<table border=1 align=center>
		<tr>
			<td></td>
			 <td>验证码:</td>
			 <td><div class="code" id="checkCode" onclick="createCode()" ><a  href="#" onclick="createCode()">换一张</a></td>
		</tr>
		<tr>
			<td>请输入验证码</td>
			<td><input type="text" size="4"  id="inputCode" /></td>
			<td><input id="Button1"  onclick="validateCode();" type="button" value="确定" /></td>
		</tr>
	</table>