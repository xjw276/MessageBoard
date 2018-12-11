<?php
error_reporting(0);
session_start();
header("Content-type: text/html; charset=utf-8");
$usnm = $_SESSION['username'];

if(!$usnm)
{
    echo "<script>alert('请登录！')</script>";
    header("Refresh:0;url=./login.html");
}
//echo $usnm;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body background = "./bj.jpg">

<body>

<div style="margin-left: 450px; margin-top: 20px;
                height: 250px; width: 250px">
    <h1 style="margin-left:800px;font-size:15px"><a href = "exit.php" >退出登录</a></h1>
    <h1 style="clear: both">您好，<?php echo $usnm; ?><br/>欢迎使用！</h1>
    <div style="margin-left: 20px">
        <a href = "addMessage.html" >添加留言</a>
    </div>
    <br/>
    <div style="margin-left: 20px">
        <a href = "showMessageForUser.php" >查看留言</a>
    </div>
	<br/>

</div>
</body>
</html>