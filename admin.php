<?php
session_start();
error_reporting(0);
$usnm = $_SESSION['username'];
$admin = $_SESSION['admin'];
if(!$admin)
{
    echo "<script>alert('越权使用！')</script>";
    exit();
}
//echo $usnm;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>


<body>
<body background = "./bj.jpg">
<div style="margin-left: 450px; margin-top: 20px;
                height: 250px; width: 250px">
    <h1 style="margin-left:800px;font-size:15px"><a href = "exit.php" >退出登录</a></h1>
    <h1 style="clear: both">您好，<?php echo $usnm; ?><br>管理员！</h1>
    <div style="margin-left: 20px">
        <a href = "showUsersForAdmin.php" >查看用户</a>
    </div>
    <br/>
    <div style="margin-left: 20px">
        <a href = "showMessageForAdmin.php" >查看留言</a>
    </div>
    <br/>

</div>
</body>
</html>