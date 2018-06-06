<?php
session_start();
if(empty($_SESSION['user']))
{
	header('location:login.php');
}
?>
<meta charset="utf-8">
<?php
require 'config.php';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$sql="select * from stu where id=$id";
	$query=mysqli_query($conn,$sql);
	$rs=mysqli_fetch_assoc($query);
	$path='upload/'.$rs['newname'];
	if(file_exists($path))
		{
			unlink($path);
			clearstatcache();
		}
			$sql="delete from stu where id=$id";
			$query=mysqli_query($conn,$sql);
			if($query)
				echo '删除成功 <script>setTimeout(\'location.href="stu.php"\',1000)</script>';
			else 
				echo '删除失败 <script>setTimeout(\'location.href="stu.php"\',1000)</script>';
		
}
?>