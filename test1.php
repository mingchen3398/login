<?php
include 'config.php';
$sql="select * from class";
$query=mysqli_query($conn,$sql);
$num=mysqli_num_rows($query);
$pageSize=1;
$pageMax=ceil($num/$pageSize);
$page=isset($_GET['page'])?$_GET['page']:1;
$page=$page>=$pageMax?$pageMax:$page;
$page=$page>1?$page:1;
$sql.=" limit ".($page-1)*$pageSize.",".$pageSize;
$query=mysqli_query($conn,$sql);
?>
<table border="1">
	<tr>
	<td>姓名</td>
	<td>性别</td>
	</tr>
	<?php
	while($rs=mysqli_fetch_assoc($query))
	{
	?>
	<tr>
	<td><?php echo $rs['id']?></td>
	<td><?php echo $rs['cname']?></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="2">
		<a href="?page=1">首页</a>
		<a href="?page=<?php if ($page>1) echo $page-1;else echo 1;?>">上一页</a>
		<a href="?page=<?php if ($page<$pageMax) echo $page+1; else echo $pageMax?>">下一页</a>
		<a href="?page=<?php echo $pageMax?>">尾页</a>
		<form>
		<input type="text" name="page" size="2"><input type="submit" name="sub" value="go"  >
		</form>
		</td>
	</tr>
</table>