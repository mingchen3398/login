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
	$sql="delete from class where id=$id";
	$query=mysqli_query($conn,$sql);
	{		
		if($query)
			echo '删除成功 <script>setTimeout(\'location.href="class.php"\',1)</script>';
		else 
			echo '删除失败<script>setTimeout(\'location.href="class.php"\',1)</script>';
	}

}
?>