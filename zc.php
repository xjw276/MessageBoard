<?php
error_reporting(0);
include('waf.php');
header("Content-type: text/html; charset=utf-8");
session_start(); // 登录之后要把所包含登录的页面连接起来，开启session
// 数据库参数
$link = mysqli_connect('localhost','root','xjw276...','messagedb');

// 取得用户名和密码
$username = $_POST['username'];
$password = md5($_POST['password']);
$repasswd = md5($_POST['repasswd']);
$authcode = $_POST['auchcode'];
$xss = strstr($username, '<');
$sqlmap = strstr($username, '\'');
$sql1 = strstr($username, '"');
//检查敏感字符
if($xss || $sqlmap || $sql1)
{
    echo "<script>alert('请勿使用敏感字符！')</script>";
    header("Refresh:0;url=./zc.html");
    exit();
}
//检查验证码

if($_SESSION['code']== $_POST['authcode'])
    ;
else
{
    echo "<script>alert('验证码输入错误！')</script>";
    header("Refresh:0;url=./zc.html");
    close();
}
//检查两遍密码
if($password != $repasswd)
{
    echo "<script>alert('两次输入的密码不一致，请重新输入！')</script>";
    header("Refresh:0;url=./zc.html");
    close();
}
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
// 连接成功,查找匹配的用户名

$sql="select password,admin from users where username = '$username'";      //从数据库查询信息
$que=mysqli_query($link,$sql);
$row=mysqli_fetch_array($que);

if(@$row)
{
    echo "<script>alert('用户名已存在，请重新输入！')</script>";
    header("Refresh:0;url=./zc.html");
    close();
}

else {
    global $username, $password;

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($link->query($sql) === TRUE)
    {
        echo "<script>alert('注册成功！')</script>";
        header("Refresh:0;url=./login.html");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
// 关闭数据库
    $conn->close();
}
?>




