<?php
session_start();
header("Content-type: text/html; charset=utf-8");
$admin = $_SESSION['admin'];
if(!$admin)
{
    echo "<script>alert('越权使用！')</script>";
    exit();
}

//echo '删除';

// 取得传过来的id
if(isset($_GET['id'])){
//    echo $_GET['id'];
}
$con=mysqli_connect("localhost","root","xjw276...","MessageDB");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

mysqli_query($con,"UPDATE users SET admin = 1 WHERE id={$_GET['id']}");


echo "<script>alert('设置成功！')</script>";
header('location:./showUsersForAdmin.php');
mysqli_close($con);
?>